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
    <h1>{{ $student->fName }}</h1>
    <table class="table table-striped">
        <tr>
            <th>Subject</th>
            <th>Semester One</th>
            <th>Semester Two</th>
            <th>Semester Three</th>
        </tr>
        @foreach ($subjects as $subject)
            <tr>
                <td>{{ $subject->subjectName }}</td>
                <td>
                    @foreach ($gradeSubjectTerms as $gradeSubjectTerm)
                        @if ($subject->subjectID === $gradeSubjectTerm[1] && $gradeSubjectTerm[2] === 1)
                            {{ $gradeSubjectTerm[0] }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($gradeSubjectTerms as $gradeSubjectTerm)
                        @if ($subject->subjectID === $gradeSubjectTerm[1] && $gradeSubjectTerm[2] === 2)
                            {{ $gradeSubjectTerm[0] }}
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($gradeSubjectTerms as $gradeSubjectTerm)
                        @if ($subject->subjectID === $gradeSubjectTerm[1] && $gradeSubjectTerm[2] === 3)
                            {{ $gradeSubjectTerm[0] }}
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
