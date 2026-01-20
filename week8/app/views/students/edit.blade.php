@extends('layouts.master')

@section('content')
    <h2>Edit Student</h2>
    
    <form action="index.php?page=update&id={{ $student['id'] }}" method="POST">
        <div style="margin-bottom: 10px;">
            <label>Name:</label><br>
            <input type="text" name="name" value="{{ $student['name'] }}" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ $student['email'] }}" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Course:</label><br>
            <input type="text" name="course" value="{{ $student['course'] }}" required>
        </div>
        
        <button type="submit" class="btn btn-edit" style="background: blue; color: white; padding: 10px; border: none; cursor: pointer;">
            Update Student
        </button>
        <a href="index.php?page=index" style="margin-left: 10px;">Cancel</a>
    </form>
@endsection