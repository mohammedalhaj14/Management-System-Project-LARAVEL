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
    <h1 class="text-center">Teachers</h1>
    <h3>Create Teacher</h3>
    <a href="{{ route('teachers.create') }}"><button type="button" class="btn btn-primary">Create</button>
    </a>
    <table class="table table-striped">
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            {{-- <th> Father</th> --}}
            {{-- <th>Mother</th> --}}
            {{-- <th>Address</th> --}}
            <th>Phone</th>
            {{-- <th>Birthdate</th> --}}
            <th>Email</th>
            {{-- <th>Gender</th> --}}
            {{-- <th>Nationality</th> --}}
            {{-- <th>Class</th> --}}
            <th>Actions</th>
        </tr>
        @forelse ($teachers as $teacher)
            <tr>
                <td>{{ $teacher->fName }}</td>
                <td>{{ $teacher->lName }}</td>
                {{-- <td>{{ $student->father }}</td> --}}
                {{-- <td>{{ $student->mother }}</td> --}}
                {{-- <td>{{ $student->address }}</td> --}}
                <td>{{ $teacher->phone }}</td>
                {{-- <td>{{ $student->birthdate }}</td> --}}
                <td>{{ $teacher->email }}</td>
                {{-- <td>{{ $student->gender->genderName }}</td> --}}
                {{-- <td>{{ $student->nationality->nationalityName }}</td> --}}
                {{-- <td>{{ $student->classID }}</td> --}}
                <td>
                    <a href="{{ route('teachers.show', $teacher->userID) }}"><button type="button"
                            class="btn btn-info">Show</button>
                    </a>
                    <form style="display: inline" action="{{ route('teachers.destroy', $teacher->userID) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td>none</td>
                <td>none</td>
                <td>none</td>
                <td>none</td>
                <td>none</td>
            </tr>
        @endforelse
    </table>
    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
@if (session('delete'))
        <div class="alert alert-primary" role="alert">
            {{ session('delete') }}
        </div>
    @endif
    <div>
        {{ $teachers->links() }}
    </div>

</body>

</html>
