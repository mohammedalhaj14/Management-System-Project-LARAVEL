<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <h1 class="text-center">Teacher</h1>
    <table class="table table-striped">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th> Father</th>
            <th>Mother</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Birthdate</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Nationality</th>
            {{-- <th>Class</th> --}}
        </tr>
        <tr>
            <td>{{ $teacher->fName }}</td>
            <td>{{ $teacher->lName }}</td>
            <td>{{ $teacher->father }}</td>
            <td>{{ $teacher->mother }}</td>
            <td>{{ $teacher->address }}</td>
            <td>{{ $teacher->phone }}</td>
            <td>{{ $teacher->birthdate }}</td>
            <td>{{ $teacher->email }}</td>
            <td>{{ $teacher->gender->genderName }}</td>
            <td>{{ $teacher->nationality->nationalityName }}</td>
            {{-- <td>{{ $teacher->classID }}</td> --}}
        </tr>

    </table>
    <h1>Classes</h1>
    <table class="table table-striped">
        <tr>
            <th>Class Name</th>
        </tr>
        @foreach ($classes as $class)
            <tr>
                <td>{{ $class->roomNbr }}</td>
            </tr>
        @endforeach
    </table>
<h1>Subjects</h1>
    <table class="table table-striped">
        <tr>
            <th>Subject Name</th>
        </tr>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{ $subject->subjectName }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
