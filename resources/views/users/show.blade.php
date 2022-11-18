@extends('layouts.app-master')
<title>User</title>
@section('content')
<div class="bg-light p-4 rounded">
    <h3>Show user</h3>
    <div class="container mt-2">
        <div>
            First Name: {{ isset($userData->fname) ? $userData->fname : '-' }}
        </div>
        <div>
            Last Name: {{isset($userData->lname) ? $userData->lname : '-'  }}
        </div>
        <div>
            Email: {{isset($userData->email) ? $userData->email : '-'  }}
        </div>
        <div>
            Mobile Number: {{ isset($userData->contact) ? $userData->contact : '-' }}
        </div>
        <div>
            Role: {{ isset($userData->roleName) ? $userData->roleName : '-' }}
        </div>
        <div>
            Designation: {{ isset($userData->designationName) ? $userData->designationName : '-' }}
        </div>
        <div>
            Business Unit: {{ isset($userData->bu_name) ? $userData->bu_name : '-' }}
        </div>
        <div>
            Account Type: {{ isset($userData->account_type) ? $userData->account_type : '-' }}
        </div>
        <div>
            Category: {{ isset($userData->category) ? $userData->category : '-' }}
        </div>
        <div>
            <?php
            if ($userData->status == 0) {
                $status = "Active";
            }
            if ($userData->status == 1) {
                $status = "Deactive";
            }
            if ($userData->status == 2) {
                $status = "Deleted";
            }
            if ($userData->status == 3) {
                $status = "Archived";
            }
            ?>
            Status: {{$status}}
        </div>

    </div>

</div>
<div class="mt-4">
    <a href="{{ route('users.edit', $userData->id) }}" class="btn btn-info">Edit</a>
    <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
</div>
@endsection