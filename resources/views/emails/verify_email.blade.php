<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Message</title>
  </head>
  <body style="background-color: #ffffff; margin: 0; padding: 0;">
    <div style="background-color: #fbbf24; padding: 16px; text-align: center;">
      <img src="{{asset('/image/Vector.png')}}" alt="My Data Clinic" style="margin: 0 auto; height: 48px;" />
      <h1 style="color: #000000; font-size: 48px; font-weight: bold; margin-top: 8px;">My Data Clinic</h1>
    </div>

    <div style="max-width: 600px; margin: 32px auto; padding: 16px;">
      <h2 style="font-size: 32px; text-align: center; font-weight: bold; margin-bottom: 16px;">
        Confirm Your Email <br />
        Address
      </h2>
      <p style="margin-bottom: 16px;">
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
        style="
          display: block;
          background-color: #fbbf24;
          color: #000000;
          text-align: center;
          padding: 8px 0;
          border-radius: 4px;
          margin: 0 auto;
          max-width: 200px;
          text-decoration: none;
        "
        >Verify Your Email Address</a
      >
    </div>

    <footer style="background-color: #e5e7eb; padding: 16px; text-align: center;">
      <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 8px;">
        <!-- Replace the placeholder URLs with the correct URLs for your social icons -->
        <a href="#">
          <img src="{{asset('/image/Twitter.png')}}" alt="Twitter" style="width: 32px; height: 32px; margin: 0 8px;" />
        </a>
        <a href="#">
          <img src="{{asset('/image/Facebook.png')}}" alt="facebook" style="width: 32px; height: 32px; margin: 0 8px;" />
        </a>
        <a href="#">
          <img
            src="{{asset('/image/Social Icons.png')}}"
            alt="Instagram"
            style="width: 32px; height: 32px; margin: 0 8px;"
          />
        </a>
      </div>
      <p style="color: #4b5563; margin-bottom: 8px;">© 2024 My Data Clinic</p>
      <p style="color: #4b5563; margin-bottom: 8px;">
        139 ST Dover Street, Boston Massachusetts. USA
      </p>
      <!-- Replace the placeholder URL with the correct URL for your additional image -->
      <img
        src="{{asset('/image/Group 5.png')}}"
        alt="Additional Image"
        style="margin: 0 auto; height: 64px;"
      />
    </footer>
  </body>
</html>
