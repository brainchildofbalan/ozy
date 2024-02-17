<?php

namespace App\Http\Controllers;

use App\Mail\OrderPlaced;
use App\Mail\OrderResponse;
use App\Mail\OrderShipped;
use App\Mail\OrderSubmitted;
use App\Models\Order;
use App\Models\Products;
use App\Models\ServicesCategory;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
  public function index()
  {
    $orders = Order::all();
    return view('admin.orders.view', compact('orders'));
  }


  public function show($id)
  {
    $orders = Order::findOrFail($id);
    return view('admin.orders.show', compact('orders'));
  }

  public function create()
  {
    $categories = ServicesCategory::all();
    return view('admin.orders.create', compact('categories'));
  }

  public function store(Request $request)
  {
    $data = $request->validate([
      'address' => 'required|string',
      'city' => 'required|string',
      'countryCode' => 'required|string',
      'email' => 'required|string',
      'firstName' => 'required|string',
      'lastName' => 'required|string',
      'phone' => 'required|string',
      'postalCode' => 'required|string',
      'time' => 'required|string',
      'zone' => 'required|string',
      'status' => 'required|string',
      'products' => 'required|string',
      'description' => 'required|string',
      'notes' => 'required|string',
      'other' => 'required|string',
    ]);

    $data['order'] = Order::count() + 1;

    // Handle image upload if needed
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('services_images', 'public');
      $data['image'] = $imagePath;
      echo $imagePath;
    }
    $data['url'] = Str::slug($request->input('name'));
    $data['updated_by'] = Str::slug($request->input('name'));
    $data['service_id'] = Uuid::uuid4()->toString();
    Order::create($data);

    return redirect()->route('orders.index')->with('success', 'Category created successfully');
  }

  // Add other methods like edit, update, delete, etc.

  public function edit($id)
  {
    $category = Order::findOrFail($id);
    $categories = ServicesCategory::all();

    return view('admin.orders.edit', compact('category', 'categories'));
  }




  public function update(Request $request, $id)
  {
    $category = Order::findOrFail($id);

    $data = $request->validate([
      'name' => 'required|string|max:255',
      'description' => 'required|string',
      'thumb_description' => 'required|string',
      'image' => 'image|mimes:jpeg,png,jpg,gif',
      'category_id' => 'required',
      'relative_products' => 'required',
    ], [
      'name.required' => 'The :attribute field is required.',
      'name.string' => 'The :attribute must be a string.',
      'name.max' => 'The :attribute must not exceed 255 characters.',

      'description.required' => 'The :attribute field is required.',
      'description.string' => 'The :attribute must be a string.',

      'thumb_description.required' => 'The :attribute field is required.',
      'thumb_description.string' => 'The :attribute must be a string.',

      'image.image' => 'The :attribute must be an image file.',
      'image.mimes' => 'The :attribute must be of type jpeg, png, jpg, or gif.',

      'category_id.required' => 'The :attribute field is required.',

      'relative_products.required' => 'The :attribute field is required.',

    ]);

    // Handle image upload if needed
    if ($request->hasFile('image')) {
      // Delete the existing image if it exists
      if ($category->image) {
        Storage::disk('public')->delete($category->image);
      }

      // Upload the new image
      $imagePath = $request->file('image')->store('services_images]\]', 'public');
      $data['image'] = $imagePath;
    }

    $data['url'] = Str::slug($request->input('name'));
    $data['updated_by'] = Str::slug($request->input('name'));
    // Update the category in the database
    $category->update($data);

    return redirect()->route('orders.index')->with('success', 'Category updated successfully');
  }






  public function destroy($id)
  {
    $category = Order::findOrFail($id);

    // Delete the associated image from storage if it exists
    if ($category->image) {
      Storage::disk('public')->delete($category->image);
    }

    // Delete the category from the database
    $category->delete();

    return redirect()->route('orders.index')->with('success', 'Category deleted successfully');
  }


  public function status($id, $status)
  {
    $data = Order::findOrFail($id);
    Order::where('id', intval($id))->update(['status' => $status]);
    $orderSubmittedEmail = new OrderResponse($data);
    $orderPlaced = new OrderPlaced($data);
    $orderShipped = new OrderShipped($data);


    // Use the Mail facade to send the email
    if ($status === "Invoice") {
      Mail::to($data->email)->send($orderSubmittedEmail);
    } else if ($status === "Placed") {
      Mail::to($data->email)->send($orderPlaced);
    } else if ($status === "Shipped") {

      Mail::to($data->email)->send($orderShipped);


      $arrayOfObjects = json_decode($data->products);
      foreach ($arrayOfObjects as $rule) {
        $product_new = Products::find($rule->id);
        if ($product_new) {
          $product_new->decrement('quantity_in_stock', $rule->qty);
        }
      }
    }
    // Mail::to($data->email)->send($orderSubmittedEmail);
    return redirect()->route('orders.show', $id)->with('success', 'Category updated successfully');
  }





  public function generate($id)
  {
    $category = Order::findOrFail($id);
    return view('admin.orders.generate', compact('category'));
  }


  public function storepdf(Request $request, $id)
  {
    $validationRules = [];
    $category = Order::findOrFail($id);
    $arrayOfObjects = json_decode($category->products);

    foreach ($arrayOfObjects as $rule) {
      $validationRules['name' . (string) $rule->id] = 'required';
    }

    foreach ($arrayOfObjects as $object) {
      // Add the new key "price" with the specified value
      $object->price = $request->input('name' . $object->id);
    }





    $total = 0;
    foreach ($arrayOfObjects as $item) {
      // Convert price to integer (assuming it's in string format)
      $price = (int) $item->price;
      $qty = $item->qty;

      // Calculate subtotal for each item
      $subtotal = $price * $qty;

      // Add subtotal to the total
      $total += $subtotal;
    }
    echo "Total: $total";





    // Create Dompdf instance
    $dompdf = new Dompdf();

    // Load HTML content
    $html = '
<style>@page { margin: 0px; }
    body { margin: 0px; }</style>
<table
  border="0"
  cellspacing="0"
  role="presentation"
  cellpadding="0"
  width="793px"
  align="center"
  style="
    max-width: 793px;
    min-width: 793px;
    border-collapse: collapse;
    background-color: #fff;
  "
>
  <tbody>
    <tr>
      <td>
        <table
          border="0"
          cellspacing="0"
          role="presentation"
          cellpadding="0"
          width="793px"
          align="center"
          style="
            max-width: 793px;
            min-width: 793px;
            border-collapse: collapse;
            background-color: #fff;
          "
        >
          
          <tr>
            <td style="width: 10px"></td>
            <td style="width: 773px">
              <table
                border="0"
                cellspacing="0"
                role="presentation"
                cellpadding="0"
                width="773px"
                align="center"
                style="
                  max-width: 773px;
                  min-width: 773px;
                  border-collapse: collapse;

                  background-color: #fff;
                "
              >
                <tbody>
                  <tr>
                    <td style="width: 100px">
                      <img
                        src="https://ozyarabia.com/assets/front-end/images/header/logo.png"
                        alt=""
                      />
                    </td>
                    <td style="width: 220px">
                      <h3
                        style="
                          font-size: 14px;
                          font-family: \'Arial\', Helvetica Neue, Helvetica,
                                        sans-serif;
                          font-weight: 700;
                          line-height: 1.4;
                          color: #000000;
                          margin-bottom: 5px;
                          margin-top: 0;
                          padding-left: 20px;
                        "
                      >
                        Ozyarabia
                      </h3>
                      <p
                        style="
                          font-size: 12px;
                          font-family: \'Arial\', Helvetica Neue, Helvetica,
                                        sans-serif;
                          font-weight: 400;
                          line-height: 1.4;
                          color: #000000;
                          margin-bottom: 0;
                          margin-top: 0;
                          padding-left: 20px;
                        "
                      >
                        Kuwait - Abraq Khaitan -Street 22 - Block 9 -Abdulaziz
                        Ahamad Al-Qadah- Off. 13 - Mezzanine
                        <br />
                        Mobile :
                        <a href="tel:+965 60327360">+965 60327360</a>
                        <br />Eamil :
                        <a href="mailto:info@ozyarabia.com"
                          >info@ozyarabia.com</a
                        >
                      </p>
                    </td>
                    <td style="width: 333px"></td>
                    <td style="width: 120px; vertical-align: top">
                      <h3
                        style="
                          font-size: 18px;
                          font-family: \'Arial\', Helvetica Neue, Helvetica,
                                        sans-serif;
                          font-weight: 400;
                          line-height: 1.4;
                          color: #0c5580;
                          margin-bottom: 0;
                          margin-top: 0;
                          text-align: right;
                        "
                      >
                        INVOICE
                      </h3>
                      <p
                        style="
                          font-size: 8px;
                          font-family: \'Arial\', Helvetica Neue, Helvetica,
                                        sans-serif;
                          font-weight: 400;
                          line-height: 1.4;
                          color: #000000;
                          margin-bottom: 0;
                          margin-top: 0;
                          text-align: right;
                        "
                      >
                        ORIGINAL FOR RECIPIENT
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
            <td style="width: 10px"></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding-top: 50px">
        <table
          border="0"
          cellspacing="0"
          role="presentation"
          cellpadding="0"
          width="793px"
          align="center"
          style="
            max-width: 793px;
            min-width: 793px;
            border-collapse: collapse;
            background-color: #fff;
          "
        >
          <tbody></tbody>
          <tr>
            <td style="width: 10px"></td>
            <td style="width: 773px">
              <table
                border="0"
                cellspacing="0"
                role="presentation"
                cellpadding="0"
                width="773px"
                align="center"
                style="
                  max-width: 773px;
                  min-width: 773px;
                  border-collapse: collapse;

                  background-color: #fff;
                "
              >
                <tbody>
                  <tr>
                    <td style="width: 300px">
                      <h3
                        style="
                          font-size: 14px;
                          font-family: \'Arial\', Helvetica Neue, Helvetica,
                                        sans-serif;
                          font-weight: 400;
                          line-height: 1.4;
                          color: #6c6c6c;
                          margin-bottom: 2px;
                          margin-top: 0;
                        "
                      >
                        Bill and ship to:
                      </h3>
                      <h4
                        style="
                          font-size: 15px;
                          font-family: \'Arial\', Helvetica Neue, Helvetica,
                                        sans-serif;
                          font-weight: 700;
                          line-height: 1.4;
                          color: #000000;
                          margin-bottom: 2px;
                          margin-top: 0;
                        "
                      >
                        ' . $category->name . '
                      </h4>
                      <p
                        style="
                          font-size: 12px;
                          font-family: \'Arial\', Helvetica Neue, Helvetica,
                                        sans-serif;
                          font-weight: 400;
                          line-height: 1.4;
                          color: #000000;
                          margin-bottom: 0;
                          margin-top: 0;
                        "
                      >
                      ' . $category->address . '
                        <br />
                        Mobile :
                        <a href="tel: ' . $category->phone . '"> ' . $category->phone . '</a>
                        <br />Eamil :
                        <a href="mailto: ' . $category->email . '"
                          > ' . $category->email . '</a
                        >
                      </p>
                    </td>
                    <td></td>
                    <td style="width: 260px; vertical-align: top">
                      <table
                        border="0"
                        cellspacing="0"
                        role="presentation"
                        cellpadding="0"
                        width="260px"
                        align="center"
                        style="
                          max-width: 260px;
                          min-width: 260px;
                          border-collapse: collapse;

                          background-color: #fff;
                        "
                      >
                        <tbody>
                          <tr>
                            <td style="width: 50%">
                              <p
                                style="
                                  font-size: 14px;
                                  font-family: \'Arial\', Helvetica Neue,
                                                Helvetica, sans-serif;
                                  font-weight: 400;
                                  line-height: 1.4;
                                  color: #6c6c6c;
                                  margin-bottom: 5px;
                                  margin-top: 0;
                                "
                              >
                                Invoice#:
                              </p>
                            </td>
                            <td style="width: 50%">
                              <p
                                style="
                                  font-size: 14px;
                                  font-family: \'Arial\', Helvetica Neue,
                                                Helvetica, sans-serif;
                                  font-weight: 700;
                                  line-height: 1.4;
                                  color: #000000;
                                  margin-bottom: 5px;
                                  margin-top: 0;
                                  text-align: right;
                                "
                              >
                              ' . $category->id . '
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 50%">
                              <p
                                style="
                                  font-size: 14px;
                                  font-family: \'Arial\', Helvetica Neue,
                                                Helvetica, sans-serif;
                                  font-weight: 400;
                                  line-height: 1.4;
                                  color: #6c6c6c;
                                  margin-bottom: 5px;
                                  margin-top: 0;
                                "
                              >
                                Invoice Date:
                              </p>
                            </td>
                            <td style="width: 50%">
                              <p
                                style="
                                  font-size: 14px;
                                  font-family: \'Arial\', Helvetica Neue,
                                                Helvetica, sans-serif;
                                  font-weight: 700;
                                  line-height: 1.4;
                                  color: #000000;
                                  margin-bottom: 5px;
                                  margin-top: 0;
                                  text-align: right;
                                "
                              >
                                10/10/2024
                              </p>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 50%">
                              <p
                                style="
                                  font-size: 14px;
                                  font-family: \'Arial\', Helvetica Neue,
                                                Helvetica, sans-serif;
                                  font-weight: 400;
                                  line-height: 1.4;
                                  color: #6c6c6c;
                                  margin-bottom: 5px;
                                  margin-top: 0;
                                "
                              >
                                Place of supply:
                              </p>
                            </td>
                            <td style="width: 50%">
                              <p
                                style="
                                  font-size: 14px;
                                  font-family: \'Arial\', Helvetica Neue,
                                                Helvetica, sans-serif;
                                  font-weight: 700;
                                  line-height: 1.4;
                                  color: #000000;
                                  margin-bottom: 5px;
                                  margin-top: 0;
                                  text-align: right;
                                "
                              >
                                Dubai
                              </p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
            <td style="width: 10px"></td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding-top: 50px">
        <table
          border="0"
          cellspacing="0"
          role="presentation"
          cellpadding="0"
          width="793px"
          align="center"
          style="
            max-width: 793px;
            min-width: 793px;
            border-collapse: collapse;
            background-color: #fff;
          "
        >
          <tbody>
            <tr>
              <td style="width: 10px"></td>
              <td style="width: 773px">
                <table
                  border="0"
                  cellspacing="0"
                  role="presentation"
                  cellpadding="0"
                  width="773px"
                  align="center"
                  style="
                    max-width: 773px;
                    min-width: 773px;
                    border-collapse: collapse;
                    background-color: #fff;
                  "
                >
                  <tbody>
                    <tr>
                      <th
                        style="
                          background: #0c5580;
                          color: #fff;
                          padding: 10px;
                          text-align: left;
                          width: 50px;
                        "
                      >
                        <p
                          style="
                            font-size: 12px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #ffffff;
                            margin-bottom: 0;
                            margin-top: 0;
                          "
                        >
                          #
                        </p>
                      </th>
                      <th
                        style="
                          background: #0c5580;
                          color: #fff;
                          padding: 10px;
                          text-align: left;
                          width: 400px;
                        "
                      >
                        <p
                          style="
                            font-size: 12px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #ffffff;
                            margin-bottom: 0;
                            margin-top: 0;
                          "
                        >
                          Item
                        </p>
                      </th>
                      <th
                        style="
                          background: #0c5580;
                          color: #fff;
                          padding: 10px;
                          text-align: left;
                        "
                      >
                        <p
                          style="
                            font-size: 12px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #ffffff;
                            margin-bottom: 0;
                            margin-top: 0;
                          "
                        >
                          Qty
                        </p>
                      </th>
                      <th
                        style="
                          background: #0c5580;
                          color: #fff;
                          padding: 10px;
                          text-align: left;
                          width: 170px;
                        "
                      >
                        <p
                          style="
                            font-size: 12px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #ffffff;
                            margin-bottom: 0;
                            margin-top: 0;
                          "
                        >
                          Rate/Item
                        </p>
                      </th>
                    </tr>
                    ';



    foreach ($arrayOfObjects as $index => $object) {

      $html .= '





                    









                    <tr>
                      <td
                        style="
                          border: 1px solid #dedede;
                          padding-top: 10px;
                          padding-bottom: 10px;
                        "
                      >
                        <p
                          style="
                            font-size: 14px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 700;
                            line-height: 1.4;
                            color: #000;
                            margin-bottom: 0;
                            margin-top: 0;
                            padding: 10px;
                          "
                        >
                        ' . $index + 1 . '
                        </p>
                      </td>
                      <td
                        style="
                          border: 1px solid #dedede;
                          padding-top: 10px;
                          padding-bottom: 10px;
                        "
                      >
                        <table
                          border="0"
                          cellspacing="0"
                          role="presentation"
                          cellpadding="0"
                          width="400px"
                          align="center"
                          style="
                            max-width: 400px;
                            min-width: 400px;
                            border-collapse: collapse;

                            background-color: #fff;
                          "
                        >
                          <tbody>
                            <tr>
                              <td style="width: 50px; height: 50px">
                              <img src="https://ozyarabia.com' . Storage::url(explode(', ', $object->images)[0]) . '"
                              style="width: 40px; height: 40px; object-fit: cover; margin: 5px; border: 1px solid #dedede; padding: 10px;">
                              </td>
                              <td style="width: 350px">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    color: #000;
                                    margin-bottom: 0;
                                    margin-top: 0;
                                    padding: 10px;
                                  "
                                >
                                  ' . $object->name . '
                                </p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td
                        style="
                          border: 1px solid #dedede;
                          padding-top: 10px;
                          padding-bottom: 10px;
                        "
                      >
                        <p
                          style="
                            font-size: 14px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 700;
                            line-height: 1.4;
                            color: #000;
                            margin-bottom: 0;
                            margin-top: 0;
                            padding: 10px;
                          "
                        >
                        x' . $object->qty . '
                        </p>
                      </td>
                      <td
                        style="
                          border: 1px solid #dedede;
                          padding-top: 10px;
                          padding-bottom: 10px;
                        "
                      >
                        <p
                          style="
                            font-size: 14px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 700;
                            line-height: 1.4;
                            color: #000;
                            margin-bottom: 0;
                            margin-top: 0;
                            padding: 10px;
                          "
                        >
                        KWD' . $object->price . '
                        </p>
                      </td>
                    </tr>





















                    ';
    }



    $html .= '










                    
                  </tbody>
                </table>
              </td>
              <td style="width: 10px"></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table
          border="0"
          cellspacing="0"
          role="presentation"
          cellpadding="0"
          width="793px"
          align="center"
          style="
            max-width: 793px;
            min-width: 793px;
            border-collapse: collapse;
            background-color: #fff;
          "
        >
          <tbody>
            <tr>
              <td style="width: 10px"></td>
              <td style="width: 773px">
                <table
                  border="0"
                  cellspacing="0"
                  role="presentation"
                  cellpadding="0"
                  width="773px"
                  align="center"
                  style="
                    max-width: 773px;
                    min-width: 773px;
                    border-collapse: collapse;
                    background-color: #fff;
                  "
                >
                  <tbody>
                    <tr>
                      <td style="border: 1px solid #dedede; border-top: 0px">
                        <p
                          style="
                            font-size: 14px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #000;
                            margin-bottom: 0;
                            margin-top: 0;
                            padding: 10px;
                            text-align: right;
                          "
                        >
                          Sub total amount
                        </p>
                      </td>
                      <td
                        style="
                          border: 1px solid #dedede;
                          border-top: 0px;
                          width: 189px;
                        "
                      >
                        <p
                          style="
                            font-size: 14px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 700;
                            line-height: 1.4;
                            color: #000;
                            margin-bottom: 0;
                            margin-top: 0;
                            padding: 10px;
                          "
                        >
                          KWD' . $total . '
                        </p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width: 10px"></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td>
        <table
          border="0"
          cellspacing="0"
          role="presentation"
          cellpadding="0"
          width="793px"
          align="center"
          style="
            max-width: 793px;
            min-width: 793px;
            border-collapse: collapse;
            background-color: #fff;
          "
        >
          <tbody>
            <tr>
              <td style="width: 10px"></td>
              <td style="width: 773px">
                <table
                  border="0"
                  cellspacing="0"
                  role="presentation"
                  cellpadding="0"
                  width="773px"
                  align="center"
                  style="
                    max-width: 773px;
                    min-width: 773px;
                    border-collapse: collapse;
                    background-color: #fff;
                  "
                >
                  <tbody>
                    <tr>
                      <td>
                        <p
                          style="
                            font-size: 16px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #000;
                            margin-bottom: 0;
                            margin-top: 0;
                            padding: 10px;
                            text-align: right;
                          "
                        >
                          TOTAL
                        </p>
                      </td>
                      <td style="border-top: 0px; width: 189px">
                        <p
                          style="
                            font-size: 16px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 700;
                            line-height: 1.4;
                            color: #000;
                            margin-bottom: 0;
                            margin-top: 0;
                            padding: 10px;
                            text-decoration: underline;
                          "
                        >
                          KWD' . $total . '
                        </p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width: 10px"></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding-top: 50px">
        <table
          border="0"
          cellspacing="0"
          role="presentation"
          cellpadding="0"
          width="793px"
          align="center"
          style="
            max-width: 793px;
            min-width: 793px;
            border-collapse: collapse;
            background-color: #fff;
          "
        >
          <tbody>
            <tr>
              <td style="width: 10px"></td>
              <td style="width: 773px">
                <table
                  border="0"
                  cellspacing="0"
                  role="presentation"
                  cellpadding="0"
                  width="773px"
                  align="center"
                  style="
                    max-width: 773px;
                    min-width: 773px;
                    border-collapse: collapse;
                    background-color: #fff;
                  "
                >
                  <tbody>
                    <tr>
                      <td style="width: 260px">
                        <h3
                          style="
                            font-size: 14px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #6c6c6c;
                            margin-bottom: 10px;
                            margin-top: 0;
                          "
                        >
                          Bank Details:
                        </h3>
                        <table
                          border="0"
                          cellspacing="0"
                          role="presentation"
                          cellpadding="0"
                          width="260px"
                          align="center"
                          style="
                            max-width: 260px;
                            min-width: 260px;
                            border-collapse: collapse;
                            background-color: #fff;
                          "
                        >
                          <tbody>
                            <tr>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                  "
                                >
                                  Bank:
                                </p>
                              </td>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 700;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                    text-align: right;
                                  "
                                >
                                  Yes Bank
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                  "
                                >
                                  Account #:
                                </p>
                              </td>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 700;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                    text-align: right;
                                  "
                                >
                                  9999999999999
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                  "
                                >
                                  IFSC:
                                </p>
                              </td>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 700;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                    text-align: right;
                                  "
                                >
                                  YES99999
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 400;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                  "
                                >
                                  Branch:
                                </p>
                              </td>
                              <td style="width: 50%">
                                <p
                                  style="
                                    font-size: 14px;
                                    font-family: \'Arial\', Helvetica Neue,
                                                  Helvetica, sans-serif;
                                    font-weight: 700;
                                    line-height: 1.4;
                                    color: #000000;
                                    margin-bottom: 5px;
                                    margin-top: 0;
                                    text-align: right;
                                  "
                                >
                                  Dubai
                                </p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td style="width: 200px"></td>
                      <td style="vertical-align: top">
                        <h3
                          style="
                            font-size: 14px;
                            font-family: \'Arial\', Helvetica Neue, Helvetica,
                                          sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            color: #6c6c6c;
                            margin-bottom: 10px;
                            margin-top: 0;
                          "
                        >
                          Bank Details:
                        </h3>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width: 10px"></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="padding-top: 50px">
        <table
          border="0"
          cellspacing="0"
          role="presentation"
          cellpadding="0"
          width="793px"
          align="center"
          style="
            max-width: 793px;
            min-width: 793px;
            border-collapse: collapse;
            background-color: #fff;
          "
        >
          <tbody>
            <tr>
              <td style="width: 10px"></td>
              <td>
                <h3
                  style="
                    font-size: 14px;
                    font-family: \'Arial\', Helvetica Neue, Helvetica,
                                  sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    color: #6c6c6c;
                    margin-bottom: 10px;
                    margin-top: 0;
                  "
                >
                  Notes:
                </h3>
                <p
                  style="
                    font-size: 14px;
                    font-family: \'Arial\', Helvetica Neue, Helvetica,
                                  sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    color: #000000;
                    margin-bottom: 10px;
                    margin-top: 0;
                  "
                >
                  Thanks for the Business
                </p>
                <h3
                  style="
                    font-size: 14px;
                    font-family: \'Arial\', Helvetica Neue, Helvetica,
                                  sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    color: #6c6c6c;
                    margin-bottom: 10px;
                    padding-top: 30px;
                    margin-top: 0;
                  "
                >
                  Terms and Conditions:
                </h3>
                <ul style="padding-left: 20px; margin-top: 0">
                  <li>
                    <p
                      style="
                        font-size: 14px;
                        font-family: \'Arial\', Helvetica Neue, Helvetica,
                                      sans-serif;
                        font-weight: 400;
                        line-height: 1.4;
                        color: #000000;
                        margin-bottom: 0px;
                        margin-top: 0;
                      "
                    >
                      Goods once sold cannot be taken back or exchanged.
                    </p>
                  </li>

                  <li>
                    <p
                      style="
                        font-size: 14px;
                        font-family: \'Arial\', Helvetica Neue, Helvetica,
                                      sans-serif;
                        font-weight: 400;
                        line-height: 1.4;
                        color: #000000;
                        margin-bottom: 0px;
                        margin-top: 0;
                      "
                    >
                      We are not the manufacturers, company will stand for
                      warranty as per their terms and conditions.
                    </p>
                  </li>

                  <li>
                    <p
                      style="
                        font-size: 14px;
                        font-family: \'Arial\', Helvetica Neue, Helvetica,
                                      sans-serif;
                        font-weight: 400;
                        line-height: 1.4;
                        color: #000000;
                        margin-bottom: 0px;
                        margin-top: 0;
                      "
                    >
                      Subject to local Jurisdiction
                    </p>
                  </li>
                </ul>
              </td>
              <td style="width: 10px"></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
';


    // Load HTML into Dompdf
    $dompdf->loadHtml($html);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Set left margin to zero
    $options = $dompdf->getOptions();
    $options->set('isPhpEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('marginLeft', 0);

    // Render the HTML as PDF
    $dompdf->render();

    // Get the PDF content
    $pdfContent = $dompdf->output();

    // Define the file path
    $filePath = 'invoice_pdf/generated' . $category->id . '.pdf'; // Relative to the storage/app/public directory

    // Store the PDF file using the Storage facade
    Storage::disk('public')->put($filePath, $pdfContent);

    // Now $imagePath contains the path to the stored PDF file
    $imagePath = Storage::url($filePath);

    // You can use $imagePath as needed, for example, to display a link to the PDF file

    Order::where('id', intval($id))->update(['products' => json_encode($arrayOfObjects), 'pdf_link' => $imagePath]);
    return redirect()->route('orders.index')->with('success', 'Category updated successfully');
  }
}