@extends('bread.admin.master')
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-12 stretch-card">
      <div class="card">
        <div class="card-body">
          <div style="display: flex;justify-content: space-between;">

            <h4 class="card-title">List Products</h4>
            <button type="button" class="btn btn-primary" onclick="showModal()">Add</button>
          </div>
          </p>
          <div class="table-responsive pt-3">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Name </th>
                  <th> Type </th>
                  <th> Description </th>
                  <th> Price </th>
                  <th> Discount Price </th>
                  <th> Image </th>
                  <th> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)

                <tr class="table-info">
                  <td> {{ $product->id }} </td>
                  <td> {{ $product->name }} </td>
                  <td> {{ $product->id_type }} </td>
                  <td> {{ $product->description }} </td>
                  <td> {{ $product->unit_price }} </td>
                  <td> {{ $product->promotion_price }} </td>
                  <td> <img src="{{ asset('image/product/' . $product->image) }}" alt=""> </td>
                  <td>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModal"> EDIT </button>
                    <button class="btn btn-danger" onclick="deleteProduct({{ $product->id }})"> DELETE</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <nav aria-label="Page navigation example" class="mt-3 d-flex justify-content-end">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="?page={{ $products->currentPage() - 1 }}">Previous</a></li>
              @for ($i = 1; $i <= $products->lastPage(); $i++)
                <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}"><a class="page-link" href="?page={{ $i }}"> {{ $i }}</a></li>
                @endfor
                <li class="page-item"><a class="page-link" href="?page={{ $products->currentPage() + 1 }}">Next</a></li>
            </ul>
          </nav>

          <div class="modal fade modal-xl" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="container">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <form onsubmit="return addProduct(event)">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" class="form-control" id="name" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Type</label>
                      <input type="text" class="form-control" id="type" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <input type="text" class="form-control" id="description" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Price</label>
                      <input type="text" class="form-control" id="unit_price" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Discount Price</label>
                      <input type="text" class="form-control" id="promotion_price" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Image</label>
                      <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" aria-describedby="inputGroupFileAddon01">
                      <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

  async function callApi(url, method, objectData = null) {
    return await $.ajax({
      url: url,
      method: method,
      data: objectData,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    }).done(function(data) {
      return data
    });
  }

  async function deleteProduct(id) {
    let data = await callApi("/admin/product-delete/" + id, 'delete');
    alert(data);
    location.reload();

  }

  async function addProduct(e) {
    e.preventDefault();
    let name = $('#name').val();
    let description = $('#description').val();
    let unit_price = $('#unit_price').val();
    let promotion_price = $('#promotion_price').val();

    let params = {name, description, unit_price, promotion_price}

    let data = await callApi("/admin/product-add", 'post', params);
    closeModal();
    return false;

  }

  async function closeModal() {
    $('#defaultModal').modal('hide')
  }

  async function showModal() {
    $('#defaultModal').modal('show')
  }
</script>
@endsection