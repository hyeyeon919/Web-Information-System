<!DOCTYPE html>
<html>

<head>
  <title>Edit Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    .profile-form {
      max-width: 400px;
      margin: 0 auto;
    }

    .profile-form label {
      display: block;
      margin-bottom: 5px;
    }

    .profile-form input,
    .profile-form input[type="file"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }

    .profile-form button {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      width: 100%;
    }

    .profile-image {
      text-align: center;
      margin-bottom: 20px;
    }

    .profile-image img {
      max-width: 200px;
      max-height: 200px;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <h1>Edit Profile</h1>
  <div class="profile-form">
    <?= form_open_multipart(base_url() . 'edituserinfo/save') ?>
      <div class="profile-image">
        <label for="profile-image">Profile Image</label>
        <input type="file" id="profile-image" name="profile-image" accept="image/*">
        <img src="#" alt="Preview" id="profile-image-preview">
      </div>

      <label for="name">Name</label>
      <input type="text" id="name" name="name" required>

      <label for="phone">PhoneNumber</label>
      <input type="tel" id="phone" name="phone" required>

      <button type="submit">Save</button>
    </form>
  </div>

  <script>
    document.getElementById("profile-image").addEventListener("change", function (e) {
      var reader = new FileReader();
      reader.onload = function (event) {
        document.getElementById("profile-image-preview").setAttribute("src", event.target.result);
      };
      reader.readAsDataURL(e.target.files[0]);
    });
  </script>
</body>

</html>