<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use App\Models\User;
use App\Models\QuizResult;
use App\Models\McqRecord;
use App\Mail\VerifyUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\userForgotPassword;
use Barryvdh\DomPDF\Facade\Pdf; 
use App\Models\Blog;

class UserController extends Controller
{
    public function welcome()
{
    $categories = Category::withCount('quizzes')
        ->orderByDesc('quizzes_count')
        ->get();

    $topQuizzes = Quiz::withCount('mcq')
        ->orderByDesc('mcq_count')
        ->take(5)
        ->get();

    return view('welcome', compact('categories', 'topQuizzes'));
}

public function categories(){
    $categories = Category::withCount('quizzes')
        ->orderByDesc('quizzes_count')
        ->paginate(4);  
    return view('categories-list',['categories'=>$categories]);
}

    public function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('Mcq')
            ->where('category_id', $id)
            ->get();

        return view('user-quiz-list', compact('quizData', 'category'));
    }

    public function startQuiz($id, $name)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();

        return view('start-quiz', [
            'quizName' => urldecode($name),
            'quizCount' => $quizCount,
            'quizId' => $id,
        ]);
    }

  public function userSignup(Request $request)
{
    $request->validate([
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:3',
        'password_confirm' => 'required|same:password',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'active' => 1,
    ]);

    $link = Crypt::encryptString($user->email);
    $link = url('/verify-user/'.$link);

    Mail::to($user->email)->send(new VerifyUser($link));

    return redirect('/user-login')
        ->with(
            'success',
            'Registration successful! Verification email sent. Please check your inbox.'
        );
}

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid credentials');
        }

        Session::put('user', $user);

return redirect('/')
    ->with('success', 'Login successful. Welcome back!');
    }

    public function userLogout()
    {
        Session::forget('user');
        Session::forget('currentquiz');

        return redirect('/')
    ->with('success', 'Logged out successfully.');
    }

 public function mcq($id, $name)
{
    $user = Session::get('user');

    if ($user) {
        McqRecord::where('user_id', $user->id)
            ->where('quiz_id', $id)
            ->delete();
    }

    $firstMcq = Mcq::where('quiz_id', $id)->first();

    if (!$firstMcq) {
        return redirect('/')->with('error', 'No questions found.');
    }

    Session::put('currentquiz', [
        'totalMcq' => Mcq::where('quiz_id', $id)->count(),
        'currentMcq' => 1,
        'quiz_id' => $id,
        'quiz_name' => urldecode($name),
    ]);

    return view('mcq-page', [
        'mcq' => $firstMcq
    ]);
}

    public function submitAndNext(Request $request, $id)
    {
        $mcq = Mcq::findOrFail($id);
        $user = Session::get('user');

        if (!$user) {
            return redirect('/')->with('error', 'Login required');
        }

        $selected = $request->answer;
        $isCorrect = ($selected == $mcq->correct_ans) ? 1 : 0;

        // SAVE ANSWER
        McqRecord::create([
            'user_id' => $user->id,
            'quiz_id' => $mcq->quiz_id,
            'mcq_id' => $mcq->id,
            'select_ans' => $selected,
            'is_correct' => $isCorrect,
        ]);

        $currentquiz = Session::get('currentquiz');

        if (!$currentquiz) {
            return redirect('/')->with('error', 'Session expired');
        }

        // NEXT QUESTION
        $nextMcq = Mcq::where('quiz_id', $mcq->quiz_id)
            ->where('id', '>', $mcq->id)
            ->orderBy('id')
            ->first();

        if ($nextMcq) {
            $currentquiz['currentMcq']++;
            Session::put('currentquiz', $currentquiz);

            return view('mcq-page', [
                'mcq' => $nextMcq
            ]);
        }

        // FINAL RESULT (NO SESSION SCORE BUGS)
        $quizId = $mcq->quiz_id;

        $score = McqRecord::where('user_id', $user->id)
            ->where('quiz_id', $quizId)
            ->where('is_correct', 1)
            ->count();

        $total = McqRecord::where('user_id', $user->id)
            ->where('quiz_id', $quizId)
            ->count();

        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;

$result = QuizResult::create([
    'user_id' => $user->id,
    'quiz_id' => $quizId,
    'score' => $score,
    'total' => $total,
]);

$results = McqRecord::with('mcq')
    ->where('user_id', $user->id)
    ->where('quiz_id', $quizId)
    ->get();

Session::forget('currentquiz');

return view('quiz-result', [
    'score' => $score,
    'total' => $total,
    'percentage' => $percentage,
    'result' => $result,
    'results' => $results
]);
    }

public function quizResult($quiz_id)
{
    $user = Session::get('user');

    if (!$user) {
        return redirect('/')->with('error', 'Login required');
    }

    $results = McqRecord::with('mcq')
        ->where('user_id', $user->id)
        ->where('quiz_id', $quiz_id)
        ->get();

    $score = $results->where('is_correct', 1)->count();
    $total = $results->count();

    $percentage = $total > 0 ? round(($score / $total) * 100) : 0;

    $result = QuizResult::where('user_id', $user->id)
            ->where('quiz_id', $quiz_id)
            ->latest()
            ->first();

    return view('quiz-result', compact(
        'results',
        'score',
        'total',
        'percentage',
        'result'
    ));
}

public function viewCertificate($id)
{
    $result = QuizResult::findOrFail($id);

    $percentage = ($result->total > 0)
        ? round(($result->score / $result->total) * 100)
        : 0;

    if($percentage < 70){
        abort(403);
    }

    return view('certificate', compact('result','percentage'));
}

public function downloadCertificate($id)
{
    $result = QuizResult::findOrFail($id);

    $percentage = ($result->total > 0)
        ? round(($result->score / $result->total) * 100)
        : 0;

    if ($percentage < 70) {
        abort(403);
    }

    $pdf = Pdf::loadView(
        'certificate',
        compact('result', 'percentage')
    )->setPaper('a4', 'landscape');

    return $pdf->download('Certificate.pdf');
}

    public function searchQuiz(Request $request)
{
    $quizData = Quiz::where('name', 'LIKE', '%' . $request->search . '%')->get();

    return view('quiz-search', [
        'quizData' => $quizData,
        'search' => $request->search
    ]);
}

    public function verifyUser($email){
        $orgEmail =  Crypt::decryptString($email);
        $user = User::where('email',$orgEmail)->first();
        if ($user){
            $user->active=2;
            //$user->save();
            
            if ($user->save()) {
    return redirect('/user-login')
        ->with('success', 'Email verified successfully. You can now login.');
}
        }
    }

    public function userForgotPassword(Request $request)
{
    $link = Crypt::encryptString($request->email);
    $link = url('/user-forgot-password/'.$link);

    Mail::to($request->email)->send(new userForgotPassword($link));

    return redirect('/')
        ->with('success', 'Password reset link has been sent to your email.');
}

    public function userResetForgotPassword($email){
    $orgEmail =  Crypt::decryptString($email);
    return view ('user-reset-password',['email'=>$orgEmail]);

    }   

    public function userResetPass(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
            'password_confirm' => 'required|same:password',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            //return $user;

            if ($user->save()) {
    return redirect('/user-login')
        ->with('success', 'Password reset successfully. Please login.');
}
        //return $request;
    }
}

public function myResults()
{
    $user = Session::get('user');

    $results = QuizResult::with('quiz')
        ->where('user_id', $user->id)
        ->latest()
        ->paginate(10);

    return view('my-results', compact('results'));
}

public function profile()
{
    $user = Session::get('user');

    $totalQuizzes = QuizResult::where('user_id', $user->id)->count();

    $certificates = QuizResult::where('user_id', $user->id)
        ->get()
        ->filter(function ($result) {
            $percentage = ($result->total > 0)
                ? round(($result->score / $result->total) * 100)
                : 0;

            return $percentage >= 70;
        })
        ->count();

    return view('profile', [
        'user' => $user,
        'totalQuizzes' => $totalQuizzes,
        'certificates' => $certificates
    ]);
}



public function blogs()
{
    $blogs = [
        (object)[
            'id' => 1,
            'title' => 'Laravel Tips for Beginners',
            'content' => 'Learn Laravel step by step...',
            'created_at' => now()
        ],
        (object)[
            'id' => 2,
            'title' => 'How to Crack Exams Faster',
            'content' => 'Smart study techniques...',
            'created_at' => now()
        ],
    ];

    return view('blogs', compact('blogs'));
}
public function blogDetail($id)
{
    $blogs = [
        (object)[
            'id' => 1,
            'title' => 'How to Prepare for Competitive Exams',
            'content' => '<p>Start with a study plan and practice daily.</p>',
            'created_at' => now()
        ],
        (object)[
            'id' => 2,
            'title' => 'Top 10 Quiz Preparation Tips',
            'content' => '<p>Consistency is the key to success.</p>',
            'created_at' => now()
        ]
    ];

    $blog = collect($blogs)->firstWhere('id', $id);

    if (!$blog) {
        abort(404);
    }

    return view('blog-detail', compact('blog'));
}

}