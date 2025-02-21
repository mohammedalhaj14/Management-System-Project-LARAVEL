<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Grade;
use App\Models\GradeUserClasseSubjectTerm;
use Hamcrest\Core\Set;
use App\Models\Subject;
use App\Models\SubjectTeacherClasse;
use App\Models\Term;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPageController extends Controller
{
    public function teacher()
    {
        $teacher = Auth::user();
        $classes = $teacher->classes;
        // return $classes;
        return view('teacher.index', ['classes' => $classes]);
    }
    public function classe(Classe $class, Subject $subject)
    {
        $teacher = Auth::user();
        $continue = SubjectTeacherClasse::where('userID', $teacher->userID)
            ->where('classID', $class->classID)
            ->where('subjectID', $subject->subjectID)
            ->get();
        if (count($continue) == 0) {
            return 'error';
        }
        $gradeRelations = GradeUserClasseSubjectTerm::where('classID', $class->classID)
            ->where('subjectID', $subject->subjectID)
            ->get();
        // return $gradeRelations;
        $terms = Term::where('active', 'Yes')->get();
        $gradeStudent = [];
        foreach ($gradeRelations as $gradeRelation) {
            if ($gradeRelation->role === 'student') {
                $grade = Grade::where('gradeID', $gradeRelation->gradeID)->get();
                $gradeStudent[] = [$grade[0]->grade, $gradeRelation->userID, $gradeRelation->termID];
            }
        }
        $students = $class->students;
        return view('teacher.class', ['class' => $class, 'subject' => $subject, 'students' => $students, 'terms' => $terms, 'gradeStudents' => $gradeStudent]);
    }
    public function addGrade(Request $request, User $student, Classe $class, Subject $subject)
    {
        $fields = $request->validate([
            'grade' => ['required', 'numeric', 'max:100'],
            'termID' => ['required', 'integer', 'exists:terms,termID'],
        ]);
        $continue = GradeUserClasseSubjectTerm::where('userID', $student->userID)
            ->where('classID', $class->classID)
            ->where('subjectID', $subject->subjectID)->where('termID',$fields['termID'])->get();
        if (count($continue) == 0) {
            $grade = Grade::create([
                'grade' => $fields['grade'],
            ]);
            GradeUserClasseSubjectTerm::create([
                'gradeID' => $grade->gradeID,
                'userID' => $student->userID,
                'classID' => $class->classID,
                'subjectID' => $subject->subjectID,
                'termID' => $fields['termID'],
            ]);
            $teacher = Auth::user();
            GradeUserClasseSubjectTerm::create([
                'gradeID' => $grade->gradeID,
                'userID' => $teacher->userID,
                'classID' => $class->classID,
                'subjectID' => $subject->subjectID,
                'termID' => $fields['termID'],
                'role' => 'teacher',
            ]);
            return redirect('/teacher');
        } else {
            return 'error';
        }
    }
}
