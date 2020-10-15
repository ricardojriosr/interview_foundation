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
                        <input type="text" class="form-control" name="git_token" id="git_token">
                        <a href="https://docs.github.com/en/free-pro-team@latest/github/authenticating-to-github/creating-a-personal-access-token" target="_blank" id="no_token">No Token? Click here to learn how to make token</a>
                    </div>

                    <div class="form-group">
                        <label>Input your GitHub Username</label>
                        <input type="text" class="form-control" name="git_username" id="git_username">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" id="submit_starred_repos_user">Submit</button>
                    </div>



                    <div class="form-group">
                        <button class="btn btn-primary" id="see_repos_user" disabled>See Repos</button>
                    </div>

                    <div class="col-12" id="git_results"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<?php $userId = Auth::id(); ?>
<script>

var gitToken  = document.getElementById("git_token");
var gitUsername  = document.getElementById("git_username");
var submitBtn = document.getElementById("submit_starred_repos_user");
var alertMsg = document.getElementById("alert_msg");
var gitResult = document.getElementById("git_results");
var noToken = document.getElementById("no_token");
var reposBtn = document.getElementById("see_repos_user");
var gitUsername;

loadTokens();

submitBtn.addEventListener("click", function() {
    if (gitToken.value == "" || gitUsername == "") {
        alertMsg.innerHTML = "Git Username and Token are Required";
        alertMsg.style.display = "block";
    } else {
        postToURL('/api/github/add/?git_token=' + gitToken.value + '&id=' + '<?php echo $userId; ?>&git_username=' + gitUsername.value);
        gitToken.value = "";
        gitUsername.value = "";
        loadTokens();
    }
});

function loadTokens() {
    var response = JSON.parse(getFromURL('/api/github/get/<?php echo $userId; ?>'));
    var count = Object.keys(response).length;
    console.log(response);
    console.log(count);
    if (count > 0) {
        gitResult.innerHTML = '<h2>Your Token is:</h2><span class="git_token">' + response['git_token'] + '</span>';
        gitUsername = response['git_username'];
        reposBtn.disabled = false;
        noToken.style.display = 'none';
    } else {
        noToken.style.display = 'block';
        reposBtn.disabled = true;
    }
}

reposBtn.addEventListener("click", function() {
    var resp = getFromURL('https://api.github.com/users/' + gitUsername + '/starred');
    console.log(resp);
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
});

</script>
@endsection
