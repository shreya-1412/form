<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">GingerWebs</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="d-flex">
      <button type="button" class="btn btn-primary" onclick = "location.href = 'logout.php' ">Logout</button>
      
    </form>
    </div>
  </nav>
  <div class="container-fluid-left">
  <div class="row">
  
  <div class="col-3">

    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active"href="dashboard.php"  aria-controls="list-home">Dashboard</a>
      <a class="list-group-item list-group-item-action active" href="profile.php"  aria-controls="list-messages">Profile</a>
      <a class="list-group-item list-group-item-action active"  href="quiz.php"  aria-controls="list-messages">Quiz</a>
      <a class="list-group-item list-group-item-action active" href="#"  aria-controls="list-messages">Setting</a>
      
     
    </div>
  </div>
  <div class="col-8">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">...</div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
    </div>
  </div>
</div>
  
  
