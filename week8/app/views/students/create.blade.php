@extends('layouts.master')

@section('content')
    <h2>Add New Student</h2>
    
    <form action="index.php?page=store" method="POST">
        <div style="margin-bottom: 10px;">
            <label>Name:</label><br>
            <input type="text" name="name" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Email:</label><br>
            <input type="email" name="email" required>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Course:</label><br>
            <input type="text" name="course" required>
        </div>
        
        <button type="submit" class="btn btn-add" style="background: green; color: white; padding: 10px; border: none; cursor: pointer;">
            Save Student
        </button>
        <a href="index.php?page=index" style="margin-left: 10px;">Cancel</a>
    </form>
@endsection