<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank youu for the order</title>
</head>

<body>
    <!-- table start  -->

    <table border="0" cellspacing="0" role="presentation" cellpadding="0" width="726px" align="center"
        style="
        max-width: 600px;
        min-width: 600px;
        border-collapse: collapse;
        border: 1px solid #f7f7f7;
        background-color: #fff;
      ">
        <tbody>
            <tr>
                <td>
                    <table border="0" cellspacing="0" role="presentation" cellpadding="0" width="600">
                        <tbody>
                            <tr>
                                <td width="600">
                                    <a href="#" target="_blank"
                                        style="display: block; width: 600px; margin-left: auto">
                                        <img src="{{ asset('/assets/admin/images/logo-01.jpg') }}" alt=""
                                            style="display: block" />
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 520px; padding-top: 37px; padding-bottom: 0px" align="center">
                    <table border="0" cellspacing="0" role="presentation" cellpadding="0" width="520">
                        <tbody>
                            <tr>
                                <td width="40"></td>
                                <td width="520"
                                    style="
                      padding-bottom: 56px;
                      font-size: 15px;
                      font-family: 'Arial', Helvetica Neue, Helvetica,
                        sans-serif;
                      font-weight: 400;
                      line-height: 1.4;
                      color: #000000;
                    ">
                                    Dear {{ $data->firstName }},<br /><br />

                                    Thank you very much for reaching out to us with your inquiry. <br /><br />

                                    Our team is currently reviewing your request and will provide you with a detailed
                                    response as soon as possible. In the meantime, please feel free to reach out if you
                                    have any further questions or need additional information <a
                                        href="mailto:info@ozyarabia.com">info@ozyarabia.com</a>. <br /><br />
                                    @php
                                        $arrayOfObjects = json_decode($data->products);
                                    @endphp





                                    <table border="1" cellspacing="0" role="presentation" cellpadding="0"
                                        width="520"
                                        style="border: 1px solid #d7d7d7;     border-collapse: collapse;">
                                        <tbody>

                                            @foreach ($arrayOfObjects as $index => $object)
                                                <tr>
                                                    <td width="70px" height="70px">
                                                        <img src="https://ozy.aneesh.website/storage/products/43fkZKzGbE3EyqJrpIHj046pmGos0gwECIIPELp1.jpg"
                                                            width="50px" height="50px"
                                                            style="object-fit: contain; width: 50px; height:  50px; padding-left: 10px;"
                                                            alt="">
                                                    </td>
                                                    <td width="300px">
                                                        <p
                                                            style=" 
                                                        font-size: 15px;
                                                    font-family: 'Arial', Helvetica Neue, Helvetica,
                                                      sans-serif;
                                                    font-weight: 400;
                                                    line-height: 1.4;
                                                    padding-left: 30px;
                                                    color: #000000;">
                                                            {{ $object->name }}
                                                        </p>
                                                    </td>
                                                    <td width="150px">
                                                        <p
                                                            style=" 
                                                font-size: 15px;
                                            font-family: 'Arial', Helvetica Neue, Helvetica,
                                              sans-serif;
                                            font-weight: 600;
                                            line-height: 1.4;
                                            padding-left: 30px;
                                            color: #000000;">
                                                            x{{ $object->qty }}
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br /><br />

                                    Once again, thank you for considering Ozyarabia. We look forward to the possibility
                                    of working together and serving your needs.<br /><br />

                                    Sincerely yours,<br />
                                    Ozyarabia
                                </td>
                                <td width="40"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="background-color: #00476f">
                    <table border="0" cellspacing="0" role="presentation" cellpadding="0" width="600"
                        align="center">
                        <tbody>
                            <tr>
                                <td width="40" style="padding-top: 30px; padding-bottom: 25px"></td>
                                <td width="384" style="padding-top: 30px; padding-bottom: 25px">
                                </td>
                                <td width="24" style="padding-top: 30px; padding-bottom: 25px">
                                    <a href="https://ozyarabia.com/" target="_blank"
                                        style="display: block; width: 24px; margin-left: auto">
                                        <img src="{{ asset('/assets/admin/images/wp.png') }}" alt=""
                                            width="24px" height="24px" />
                                    </a>
                                </td>
                                <td width="20" style="padding-top: 30px; padding-bottom: 25px"></td>
                                <td width="24" style="padding-top: 30px; padding-bottom: 25px">
                                    <a href="https://ozyarabia.com/" target="_blank"
                                        style="display: block; width: 24px; margin-left: auto">
                                        <img src="{{ asset('/assets/admin/images/call.png') }}" alt=""
                                            width="24px" height="24px" />
                                    </a>
                                </td>
                                <td width="20" style="padding-top: 30px; padding-bottom: 25px"></td>
                                <td width="24" style="padding-top: 30px; padding-bottom: 25px">
                                    <a href="https://ozyarabia.com/" target="_blank"
                                        style="display: block; width: 24px; margin-left: auto">
                                        <img src="{{ asset('/assets/admin/images/facebook.png') }}" alt=""
                                            width="24px" height="24px" />
                                    </a>
                                </td>
                                <td width="20" style="padding-top: 30px; padding-bottom: 25px"></td>
                                <td width="24" style="padding-top: 30px; padding-bottom: 25px">
                                    <a href="https://ozyarabia.com/" target="_blank"
                                        style="display: block; width: 24px; margin-left: auto">
                                        <img src="{{ asset('/assets/admin/images/instagram.png') }}" alt=""
                                            width="24px" height="24px" />
                                    </a>
                                </td>
                                <td width="20" style="padding-top: 30px; padding-bottom: 25px"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- table end -->
</body>

</html>
