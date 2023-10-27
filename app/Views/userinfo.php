<!DOCTYPE html>
<html>

<head>
  <title>User info</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    .profile-info {
      max-width: 400px;
      margin: 0 auto;
    }

    .profile-info label {
      display: block;
      margin-bottom: 5px;
    }

    .profile-info input {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: none;
      background-color: #f7f7f7;
    }

    .profile-info button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      width: 100%;
    }
  </style>
</head>

<body>
  <h1>User info</h1>
  <div class="profile-info">
    <form>
      <?php
      $db = \Config\Database::connect();

      $session = session();
      $name = $session->get('username');

      $builder = $db->table('users');

      $username = $name;
      $builder->where('username', $name);

      $query = $builder->get();
      $results = $query->getRow();
      $path = base_url('writable/users/' . $results->profile);
      ?>

      <div style="text-align: center;">
        <img src="<?php echo $path; ?>" alt="Profile Image">
      </div> <label for="name">name</label>
      <input type="text" id="name" name="name" value="<?php echo $results->name; ?>" readonly>

      <label for="username">username</label>
      <input type="text" id="username" name="username" value="<?php echo $name;
      ?>" readonly>

      <label for="password">password</label>
      <input type="password" id="password" name="password" value="*********" readonly>

      <label for="phone">phonenumber</label>
      <input type="text" id="phone" name="phone" value="<?php echo $results->phonenumber; ?>" readonly>

      <button type="button" onclick="window.location.href = 'edituserinfo'">Edit Profile</button>
      <button type="button" onclick="window.location.href = 'favlist'">My Fav List</button>

      <button type="button" onclick="window.location.href = '/demo'">back</button>

    </form>
  </div>
</body>

</html>