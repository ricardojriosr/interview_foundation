@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="alert alert-danger" role="alert" id="alert_msg"></div>

                    <div class="form-group">
                        <label>Input your GitHub Token</label>
                        <input type="text" class="form-control" name="git_username" id="git_username">
                        <a href="https://docs.github.com/en/free-pro-team@latest/github/authenticating-to-github/creating-a-personal-access-token" target="_blank">No Token? Click here to learn how to make token</a>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" id="submit_starred_repos_user">Submit</button>
                    </div>

                    <div class="row" id="git_results"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
