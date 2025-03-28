<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Blog Post Notification</title>
    <style type="text/css">
        body {
            width: 100%;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            border-collapse: collapse;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        a img {
            border: none;
        }

        p {
            margin: 0;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        @media screen and (max-width: 600px) {
            table[class="container"] {
                width: 100% !important;
            }

            img[class="responsive-img"] {
                width: 100% !important;
                height: auto !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0;">
    <table cellpadding="0" cellspacing="0" border="0" width="100%" bgcolor="#f4f4f4">
        <tr>
            <td align="center">
                <table class="container" cellpadding="0" cellspacing="0" border="0" width="600" style="width: 600px; margin: 20px auto;">
                    <tr>
                        <td bgcolor="#ffffff" style="padding: 20px;">
                            <h2 style="font-size: 24px; margin-bottom: 10px;">New Blog Post: {{ $post->title }}</h2>

                            <img src="{{ asset('images/posts/'.$post->featured_image) }}" alt="Post Image" class="responsive-img" style="max-width: 100%; height: auto; margin-bottom: 15px;" />

                            <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">
                                {!! Str::ucfirst(words($post->content,43)) !!}
                            </p>

                            <div style="text-align: center;">
                                <a href="{{ route('read_post',$post->slug) }}" style="background-color: #007bff; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block;">Read More</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
