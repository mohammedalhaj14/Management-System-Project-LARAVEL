 <form action="/image" method="POST" enctype="multipart/form-data">
     @error('image')
         <span style="color: red">{{ $message }}</span>
     @enderror
     @csrf
     <input type="file" name="image" id="">
     <input type="submit" value="Submit">
 </form>
 <img src="{{ asset('storage/images/IMG_bdPRWcW3ESGM.jpg') }}" alt="">
