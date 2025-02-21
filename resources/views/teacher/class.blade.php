<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Document</title>
</head>

<body>
    <h1 class="text-center">Class: {{ $class->roomNbr }}</h1>
    <h3 class="text-center">Subject: {{ $subject->subjectName }}</h3>
    <table class="table table-striped">
        <tr>
            <th>Student Name</th>
            <th>Grade</th>
            <th>Term</th>
            <th>Submit</th>
        </tr>
        @foreach ($students as $student)
        @endforeach
        <tr>
            <td>{{ $student->fName }}</td>
            @error('grade')
                <span style="color: red;">{{ $message }}</span>
            @enderror
            <form action="/addGrade/{{ $student->userID }}/{{ $class->classID }}/{{ $subject->subjectID }}"
                method="POST">
                @csrf
                <td><input
                        @foreach ($gradeStudents as $stud)
@if ($student->userID === $stud[1] && $stud[2] === $terms[0]->termID)
value = {{ $stud[0] }}
@disabled(true)
@endif @endforeach
                        type="text" name="grade"></td>
                <td>
                    <select class="form-select" name="termID" aria-label="Default select example">
<option value="{{$terms[0]->termID}}">{{$terms[0]->termName}}</option>
                    </select>
                </td>
                <td><input class="btn btn-warning"
                        @foreach ($gradeStudents as $stud)
@if ($student->userID === $stud[1] && $stud[2] === $terms[0]->termID)
@disabled(true)
@endif @endforeach
                        type="submit" value="Submit"></td>
            </form>

        </tr>

</body>

</html>
