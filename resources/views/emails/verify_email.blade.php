<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Message</title>
    <!-- Include Tailwind CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-white">
    <div class="bg-yellow-400 py-4 text-center">
      <img src="{{asset('/image/Vector.png')}}" alt="My Data Clinic" class="mx-auto h-12" />
      <h1 class="text-dark text-6xl font-bold mt-2">My Data Clinic</h1>
    </div>

    <div class="container mx-auto py-8 px-4">
      <h2 class="text-4xl text-center font-bold mb-4">
        Confirm Your Email <br />
        Address
      </h2>
      <p class="mb-4">
        Thank you for creating an account with us! To ensure that you receive
        important updates and notifications, we need to confirm your email
        address.
        <br /><br />
        Please click on the link below to confirm your email address:
        <br /><br />
        If you are unable to click on the link, please copy and paste it into
        your web browser.
        <br /><br />
        Once you confirm your email address, you will be able to access your
        account and start using our services.
        <br /><br />
        If you did not sign up for an account with us, please disregard this
        email.
        <br /><br />
        Thank you for your prompt attention to this matter.
      </p>
      <a
        href="{{ $verificationUrl }}"
        class="block bg-yellow-400 text-dark text-center py-2 rounded mx-auto max-w-xs"
        >Verify Your Email Address</a
      >
    </div>

    <footer class="bg-gray-200 py-4 text-center">
      <div class="flex justify-center items-center mb-2">
        <!-- Replace the placeholder URLs with the correct URLs for your social icons -->
        <a href="#">
          <img src="{{asset('/image/Twitter.png')}}" alt="Twitter" class="w-8 h-8 mx-2" />
        </a>
        <a href="#">
          <img src="{{asset('/image/Facebook.png')}}" alt="facebook" class="w-8 h-8 mx-2" />
        </a>
        <a href="#">
          <img
            src="{{asset('/image/Social Icons.png')}}"
            alt="Instagram"
            class="w-8 h-8 mx-2"
          />
        </a>
      </div>
      <p class="text-gray-600 mb-2">© 2024 My Data Clinic</p>
      <p class="text-gray-600 mb-2">
        139 ST Dover Street, Boston Massachusetts. USA
      </p>
      <!-- Replace the placeholder URL with the correct URL for your additional image -->
      <img
        src="{{asset('/image/Group 5.png')}}"
        alt="Additional Image"
        class="mx-auto h-16"
      />
    </footer>
  </body>
</html>
