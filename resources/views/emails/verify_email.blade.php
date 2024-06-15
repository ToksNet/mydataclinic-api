<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Email Message</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@1000&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000&family=Inter:wght@100..900&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inter:wght@100..900&display=swap" rel="stylesheet" />
 
</head>

<body style="background-color: #ffffff; margin: 0; padding: 0">
  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
    <tr>
      <td align="center" style="padding: 32px 16px;">
        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
          <tr>
            <td style="padding: 0;">
              <div style=" align-items: center; justify-content: center; text-align: center; background-color: #fbbf24; padding: 32px 16px;">
                <img src="{{asset('/image/vector.png')}}" alt="My Data Clinic" class="vector-large" class="vector-small" style="height: 48px; margin-left: 0;" />
                <h1 style="color: #000000; font-size: 32px; font-family: 'Anton', sans-serif; font-weight: 1000; margin: 0;">
                  MyDataClinic
                </h1>
              </div>
            </td>
          </tr>
          <tr>
            <td style="padding: 16px;">
              <div style="margin: 0 auto 32px auto; padding: 16px; background-color: #ffffff; border-radius: 8px;">
                <h2 style="text-align: center; color: #000000; font-weight: bold; font-size: 24px; font-family: 'DM Sans', sans-serif; margin-bottom: 16px; margin-top: 0;">
                  Confirm Your Email <br />Address
                </h2>
                <p style="margin-bottom: 16px; color: #000000; font-size: 13px; font-family: 'Inter', sans-serif;">
                  Thank you for creating an account with us! To ensure that you
                  receive important updates and notifications, we need to confirm your
                  email address.
                  <br /><br />
                  Please click on the link below to confirm your email address:
                  <br /><br />
                  If you are unable to click on the link, please copy and paste it
                  into your web browser.
                  <br /><br />
                  Once you confirm your email address, you will be able to access your
                  account and start using our services.
                  <br /><br />
                  If you did not sign up for an account with us, please disregard this
                  email.
                  <br /><br />
                  Thank you for your prompt attention to this matter.
                </p>
                <a href="{{ $verificationUrl }}" style="display: block; background-color: #fbbf24; color: #000000; text-align: center; padding: 8px 0; border-radius: 4px; margin: 0 auto; max-width: 200px; margin-bottom: 16px; font-weight: bold; font-size: 13px; font-family: 'DM Sans', sans-serif; text-decoration: none;">Verify Your Email Address</a>
              </div>
            </td>
          </tr>
          <tr>
            <td style="background-color: #e5e7eb; padding: 16px; text-align: center;">
              <div style="justify-content: center; align-items: center; margin-bottom: 8px;">
                <a href="#">
                  <img src="{{asset('/image/twitter.png')}}" alt="Twitter" style="width: 32px; height: 32px; margin: 0 8px;" />
                </a>
                <a href="#">
                  <img src="{{asset('/image/facebook.png')}}" alt="facebook" style="width: 32px; height: 32px; margin: 0 8px;" />
                </a>
                <a href="#">
                  <img src="{{asset('/image/social_icons.png')}}" alt="Instagram" style="width: 32px; height: 32px; margin: 0 8px;" />
                </a>
              </div>
              <p style="color: #4b5563; margin-bottom: 8px; font-weight: bold; color: #000000; font-size: 15px; font-family: 'DM Sans', sans-serif;">
                MyDataclinic.com
              </p>
              <p style="color: #4b5563; margin-bottom: 8px;">
                139 ST Dover Street, Boston Massachusetts. USA
              </p>
              <img src="{{asset('/image/group_5.png')}}" alt="MyDataClinicLogo" style="margin: 0 auto; height: 64px;" />
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
