<?php $this->layout('layout', ['title' => 'Store']) ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-3 mb-2">
          <h2>Products</h2>
        </div>
        <div class="col-md-12 mt-1 mb-4">
          <a href="/create" class="btn btn-success">Create</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table table-bordered">
            <thead class="table-active">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                <tr>
                  <th scope="row"><?= $product['id'] ?></th>
                  <td><?= $product['title'] ?></td>
                  <td><?= $product['description'] ?></td>
                  <td><?= $product['price'] ?></td>
                  <td>
                    <a href="/show/<?= $product['id'] ?>" class="btn btn-info mr-2 mb-2">Show</a>
                    <a href="/edit/<?= $product['id'] ?>" class="btn btn-warning mr-2 mb-2">Edit</a>
                    <a onclick="return confirm('Are you sure?')"; 
                       href="/delete/<?= $product['id'] ?> "class="btn btn-danger mr-2 mb-2">Delete</a>
                  </td>
                </tr>
                <?php endforeach ?>
            </tbody>
          </table>

          <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                <?php if ($page == 1) : ?>
                  <a class="page-link" href="/store/<?= $page ?>" aria-label="Previous">
                <?php else : ?>
                  <a class="page-link" href="/store/<?= $page-1 ?>" aria-label="Previous">
                <?php endif; ?>
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for ($i=1; $i <= $countPages; $i++) : ?>
                <li class="page-item"><a class="page-link" href="/store/<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>
                <li class="page-item">
                <?php if ($page == $countPages) : ?>
                  <a class="page-link" href="/store/<?= $page ?>" aria-label="Next">
                <?php else : ?>
                  <a class="page-link" href="/store/<?= $page+1 ?>" aria-label="Next">
                <?php endif; ?>
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
          </nav>

        </div>
      </div>
    </div>