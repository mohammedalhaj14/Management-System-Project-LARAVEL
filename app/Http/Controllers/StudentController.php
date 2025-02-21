<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where('role', 'student')->paginate(15);
        return view('admin.students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all();
        $nationalities = Nationality::all();
        $classes = Classe::where('nbrStud', '<', 30)->get();
        return view('admin.students.create', ['genders' => $genders, 'nationalities' => $nationalities, 'classes' => $classes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'fName' => ['required', 'string', 'max:10'],
            'lName' => ['required', 'string', 'max:10'],
            'father' => ['required', 'string', 'max:10'],
            'mother' => ['required', 'string', 'max:10'],
            'address' => ['required', 'min:3'],
            'phone' => ['required', 'min:8', 'max:8', 'unique:users,phone'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'genderID' => ['required', 'integer', 'exists:genders,genderID'],
            'nationalityID' => ['required', 'integer', 'exists:nationalities,nationalityID'],
            'classID' => ['required', 'integer', 'exists:classes,classID'],
        ]);
        $class = Classe::find($fields['classID']);
        if ($class->nbrStud < $class->maxNbrStud) {
            $class->update([
                'nbrStud' => $class->nbrStud + 1,
            ]);
            $user = User::create($fields);
            // Auth::login($user);

            // event(new Registered($user));
            // return to_route('verification.notice');
            return to_route('students.index')->with('success', 'Created successfully');
        }
        return to_route('students.create')->with('error', 'This class is full');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        if ($student->role !== 'student') {
            return to_route('students.index');
        }
        return view('admin.students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        $student->delete();
        // return to_route('students.index')->with('delete', 'Deleted Successfully');
        return response()->json(['delete']);
    }
    public function classe()
    {
        return view('admin.classe');
    }
    public function editClasse(Request $request)
    {
        $fields = $request->validate([
            'schoolarYear' => ['required', 'integer', 'max:3000'],
        ]);
        Classe::query()->update(['schoolarYear' => $fields['schoolarYear'], 'nbrStud' => 0]);
        return redirect('/dashboard');
    }

    public function terms()
    {
        $terms = Term::all();
        return view('admin.terms', ['terms' => $terms]);
    }
    public function editTerm(Request $request)
    {
        $fields = $request->validate([
            'termID' => ['required', 'integer', 'exists:terms,termID'],
        ]);
        $term = Term::where('active', 'Yes')->update([
            'active' => 'No',
        ]);
        $term = Term::find($fields['termID']);
        $term->update([
            'active' => 'Yes',
        ]);
        return redirect('/terms');
    }
}
