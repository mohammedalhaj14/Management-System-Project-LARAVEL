<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <h1>Create Student</h1>
    <div class="w-50" style="padding: 10px;">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">First Name</label>
                @error('fName')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('fName') }}" name="fName" type="text" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                @error('lName')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('lName') }}" name="lName" type="text" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Father</label>
                @error('father')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('father') }}" name="father" type="text" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Mother</label>
                @error('mother')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('mother') }}" name="mother" type="text" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Address</label>
                @error('address')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('address') }}" name="address" type="text" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone</label>
                @error('phone')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('phone') }}" name="phone" type="tel" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Birthdate</label>
                @error('birthdate')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('birthdate') }}" name="birthdate" type="date" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input value="{{ old('email') }}" name="email" type="text" class="form-control"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                @error('password')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Gender</label>
                @error('genderID')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <select name="genderID" class="form-select" aria-label="Default select example">
                    @foreach ($genders as $gender)
                        <option value="{{ $gender->genderID }}">{{ $gender->genderName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nationality</label>
                @error('nationalityID')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <select name="nationalityID" class="form-select" aria-label="Default select example">
                    @foreach ($nationalities as $nationality)
                        <option value="{{ $nationality->nationalityID }}">{{ $nationality->nationalityName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Class</label>
                @error('classID')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                <select name="classID" class="form-select" aria-label="Default select example">
                    @foreach ($classes as $class)
                        <option value="{{ $class->classID }}">{{ $class->roomNbr }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            @if (session('error'))
                <p style="color: red">{{ session('error') }}</p>
            @endif
        </form>
    </div>
</body>

</html>
