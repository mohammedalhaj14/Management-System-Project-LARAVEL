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
    <h1 class="text-center">Sudent</h1>
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
            <th>Class</th>
        </tr>
            <tr>
                <td>{{ $student->fName }}</td>
                <td>{{ $student->lName }}</td>
                <td>{{ $student->father }}</td>
                <td>{{ $student->mother }}</td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->birthdate }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->gender->genderName }}</td>
                <td>{{ $student->nationality->nationalityName }}</td>
                <td>{{ $student->classID }}</td>
            </tr>

    </table>

</body>

</html>
