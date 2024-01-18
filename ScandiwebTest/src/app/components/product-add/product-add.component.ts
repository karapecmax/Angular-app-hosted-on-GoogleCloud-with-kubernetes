import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Product } from 'src/app/products-interface';
import { ProductService } from 'src/app/shared-services.service';

@Component({
  selector: 'app-product-add',
  templateUrl: './product-add.component.html',
  styleUrls: ['./product-add.component.scss']
})
export class ProductAddComponent implements OnInit {
  manageProducts: FormGroup;
  skuShow = false;

  ngOnInit(): void {
    this.manageProducts.get('type')?.valueChanges.subscribe((type) => {
    });
  }

  constructor(
    private formBuilder: FormBuilder,
    private productService: ProductService,
  ) {
    this.manageProducts = this.formBuilder.group({
      name: ['', Validators.required],
      sku: ['', Validators.required],
      price: ['', Validators.required],
      type: ['', Validators.required],
      size: [''],
      weight: [''],
      dimensions: this.formBuilder.group({
        height: [''],
        width: [''],
        length: ['']
      })
    });

    this.manageProducts.get('type')?.valueChanges.subscribe(type => {
      this.manageProducts.get('sku')?.setValue(this.generateInitialSku(type));
    });
  }

  private generateInitialSku(type: string): string {
    switch (type) {
      case 'disk':
        return 'JVC-';
      case 'book':
        return 'GGWP-';
      case 'furniture':
        return 'TR-';
      default:
        return '';
    }
  }

  createProduct(formData: any) {
    this.manageProducts.get('dimensions')?.setValue({
      height: formData.dimensions?.height,
      width: formData.dimensions?.width,
      length: formData.dimensions?.length,
    });
    this.productService.addProduct(this.manageProducts.value).subscribe({
      next: (response) => {
        console.log(response);
      },
      error: (error) => {
        console.error(error);
      },
      complete: () => {
      }
    });

    console.log(this.manageProducts.value);
  }
}