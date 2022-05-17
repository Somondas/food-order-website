<?php
include './dbconnect.php';
include 'check-login.php';
 ?>


<div class="menu">
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #fc6203;">
  <!-- <a class="navbar-brand" href="#">Food-order</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./manage-admin.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./category.php">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./manage-food.php">Food</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./manage-order.php">Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./logout.php">Logout</a>
      </li>


    </ul>

  </div>
</nav>
</div>
