<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Classe;
use App\Models\ClassTeacher;
use App\Models\Gender;
use App\Models\Nationality;
use App\Models\Subject;
use App\Models\SubjectTeacherClasse;
use App\Models\TeacherSubject;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = User::where('role', 'teacher')->paginate(15);
        return view('admin.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genders = Gender::all();
        $nationalities = Nationality::all();
        $classes = Classe::all();
        $subjects = Subject::all();
        return view('admin.teachers.create', ['genders' => $genders, 'nationalities' => $nationalities, 'classes' => $classes, 'subjects' => $subjects]);
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
            'classID' => ['required', 'array'],
            'classID.*' => ['required', 'integer', 'exists:classes,classID'],
            'subjectID' => ['required', 'array'],
            'subjectID.*' => ['required', 'integer', 'exists:subjects,subjectID'],
        ]);
        //check class and subject => should be equal
        $array = [];
        if (count($fields['subjectID']) === count($fields['classID'])) {
            for ($i = 0; $i < count($fields['subjectID']); $i++) {
                $array[] = [$fields['subjectID'][$i], $fields['classID'][$i]];
                $class = Classe::find($fields['classID'][$i]);
                $certificateDepartment = $class->certificateDepartmentID;
                $subject = Subject::find($fields['subjectID'][$i]);
                $certificateDepartments = $subject->certificateDepartments;
                $true = [];
                foreach ($certificateDepartments as $a) {
                    if ($a->certificateDepartmentID === $certificateDepartment) {
                        $true[] += true;
                    } else {
                        $true[] += false;
                    }
                }
                $complete = 'no';
                foreach ($true as $t) {
                    if ($t === 1) {
                        $complete = 'true';
                        break;
                    }
                }
                if ($complete == 'no') {
                    return to_route('teachers.create')->with('error 1', 'You cannot put this subject in ths class');
                }
                // return 'true';
            }
            for ($i = 0; $i < count($array); $i++) {
                for ($j = 0; $j < count($array); $j++) {
                    if ($i !== $j) {
                        if ($array[$i][0] === $array[$j][0] && $array[$i][1] === $array[$j][1]) {
                            return to_route('teachers.create')->with('error 1', 'You cannot use the same subject class twice');
                        }
                    }
                }
            }
            // return 'true';
            $user = User::create([
                'fName' => $fields['fName'],
                'lName' => $fields['lName'],
                'father' => $fields['father'],
                'mother' => $fields['mother'],
                'address' => $fields['address'],
                'phone' => $fields['phone'],
                'birthdate' => $fields['birthdate'],
                'email' => $fields['email'],
                'password' => $fields['password'],
                'role' => 'teacher',
                'genderID' => $fields['genderID'],
                'nationalityID' => $fields['nationalityID'],
            ]);
            for ($i = 0; $i < count($fields['classID']); $i++) {
                SubjectTeacherClasse::create([
                    'userID' => $user->userID,
                    'subjectID' => $fields['subjectID'][$i],
                    'classID' => $fields['classID'][$i],
                ]);
            }
            foreach ($fields['classID'] as $class) {
                ClassTeacher::create([
                    'classID' => $class,
                    'userID' => $user->userID,
                ]);
            }
            foreach ($fields['subjectID'] as $subject) {
                TeacherSubject::create([
                    'userID' => $user->userID,
                    'subjectID' => $subject,
                ]);
            }
            // Auth::login($user);

            // event(new Registered($user));
            // return to_route('verification.notice');
            return to_route('teachers.index')->with('success', 'Created successfully');

            // return to_route('teachers.create')->with('error', 'This class is full');
        } else {
            return to_route('teachers.create')->with('error 1', 'Each Class Should have a subject');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $teacher)
    {
        if ($teacher->role !== 'teacher') {
            return to_route('teachers.index');
        }
        $classes = $teacher->classes;
        $subjects = $teacher->subjects;
        return view('admin.teachers.show', ['teacher' => $teacher, 'classes' => $classes, 'subjects' => $subjects]);
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
    public function destroy(User $teacher)
    {
        $teacher->delete();
        return to_route('teachers.index')->with('delete', 'Deleted Successfully');
    }
}
