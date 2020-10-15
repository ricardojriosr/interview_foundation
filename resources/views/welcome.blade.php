@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Starred Repositories Search</div>

                <div class="card-body">

                    <div class="alert alert-danger" role="alert" id="alert_msg"></div>

                    <div class="form-group">
                        <label>Input your GitHub Username</label>
                        <input type="text" class="form-control" name="git_username" id="git_username">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" id="submit_starred_repos_user">Submit</button>
                    </div>

                    <div class="row" id="git_results">

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>

var starredBtn = document.getElementById("submit_starred_repos_user");
var alertMsg = document.getElementById("alert_msg");
var gitResult = document.getElementById("git_results");

if (starredBtn) {
    starredBtn.addEventListener("click", function(e) {
        var gitUser = document.getElementById("git_username").value;
        if (gitUser == "") {
            alertMsg.innerHTML = "Git Username is Required";
            alertMsg.style.display = "block";
            gitResult.innerHTML = "";
        } else {
            var resp = getFromURL('https://api.github.com/users/' + gitUser + '/starred');
            var responseHTML = '<ul class="list-group full-width">';
            resp = JSON.parse(resp);
            for (var key in resp) {
                if (resp.hasOwnProperty(key)) {
                    console.log(resp[key]);
                    let thisLoop = resp[key];
                    responseHTML += '<li class="list-group-item item-flex">'
                    responseHTML += '<span class="name"><strong>' + thisLoop['name'] + '</strong></span>';
                    responseHTML += '<span class="link"><a href="' + thisLoop['clone_url'] + '" target="_blank">Link</a></span>';
                    responseHTML += '</li>';
                }
            }
            responseHTML += '</ul>';
            gitResult.innerHTML = responseHTML;
        }
    });
}
</script>
@endsection
