@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/houses">View your Houses &raquo;</a><br /><br />
                    <a href="/messages">View your Messages &raquo;</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
