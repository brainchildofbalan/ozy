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

                                    We hope this email finds you well. We are delighted to confirm the placement of your
                                    order with us. Thank you for choosing.<br /><br />

                                    <ul>
                                        <li>Order ID: {{ $data->id }}</li>
                                        <li>Customer Name: {{ $data->firstName }}</li>
                                        <li>Customer Email: {{ $data->email }}</li>
                                        <li>Customer Mobile: {{ $data->phone }}</li>
                                        <li>Customer Address: {{ $data->address }}</li>
                                        <li>Placed Date: {{ $data->created_at }}</li>


                                        <br /><br />
                                        Product Details:<br />
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
                                                            <img src="https://ozyarabia.com/storage/products/43fkZKzGbE3EyqJrpIHj046pmGos0gwECIIPELp1.jpg"
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

                                        Thank you once again for your order. We sincerely appreciate your business and
                                        look forward to serving you.
                                        <br /><br />

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
