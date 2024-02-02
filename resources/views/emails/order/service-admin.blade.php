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
                                    Hello Admin,<br /><br />

                                    A new service enquiry has been received with the following details. <br /><br />

                                    <ul>
                                        <li>Service ID: {{ $data->id }}</li>
                                        <li>Customer Name: {{ $data->name }}</li>
                                        <li>Customer Email: {{ $data->email }}</li>
                                        <li>Customer Mobile: {{ $data->number }}</li>
                                        <li>Customer Address: {{ $data->address }}</li>
                                        <li>Placed Date: {{ $data->created_at }}</li>


                                        <!-- Add more details as needed -->
                                    </ul>

                                    Please take necessary actions accordingly.<br /><br />




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
