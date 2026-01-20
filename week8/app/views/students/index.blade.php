@extends('layouts.master')

@section('content')
    <h1>Student List</h1>
    <a href="index.php?page=create" class="btn btn-add">Add New Student</a>
    <br><br>
    <table>
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
        </tr>
        @foreach($students as $student)
        <tr>
            <td>{{ $student['id'] }}</td>
            <td>{{ $student['name'] }}</td>
            <td>{{ $student['email'] }}</td>
            <td>{{ $student['course'] }}</td>
            <td>
                <a href="index.php?page=edit&id={{ $student['id'] }}" class="btn btn-edit">Edit</a>
                <a href="index.php?page=delete&id={{ $student['id'] }}" class="btn btn-delete" onclick="return confirm('Delete this record?')">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection