import { Component, OnInit } from '@angular/core';
import { ApiResponse, Product } from 'src/app/products-interface';
import { ProductService } from 'src/app/shared-services.service';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.scss']
})

export class ProductListComponent implements OnInit {
  massDeleteShow = false;
  selectedProductIds: number[] = [];
  productListExample: Product[] = [];
  success: boolean = false;

  ngOnInit(): void {
    this.getProducts();
  }

  constructor(
    private ProductService: ProductService,
  ) { }


  getProducts() {
    this.ProductService.getProducts().subscribe((response) => {
      console.log(response)
      this.success = response.success;
      this.productListExample = response.data;
    });
  }

  handleCheckboxChange(productId: number) {

    this.massDeleteShow = true;

    const index = this.selectedProductIds.indexOf(productId);
    if (index === -1) {
      this.selectedProductIds.push(productId);

    } else {

      this.selectedProductIds.splice(index, 1);

    }
  }

  deleteSelectedProducts() {

    if (this.selectedProductIds.length > 0) {
      this.ProductService.deleteProducts(this.selectedProductIds).subscribe(response => {
        if (response.success) {
          setTimeout(() => {
            this.getProducts();
          }, 5000)
          this.selectedProductIds = [];
        } else {
        }
      });
    }
  }
}
