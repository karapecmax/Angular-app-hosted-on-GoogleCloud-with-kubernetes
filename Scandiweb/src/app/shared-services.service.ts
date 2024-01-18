import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { ApiResponse, Product } from './products-interface';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  private addProductsUrl = 'http://35.225.60.236/add_product.php';
  private getProductsUrl = 'http://35.225.60.236/get_products.php'
  private deleteProductsUrl = 'http://35.225.60.236/delete_products.php'

  constructor(private http: HttpClient) { }

  addProduct(productData: any) {
    return this.http.post(this.addProductsUrl, productData);
  }

  getProducts(): Observable<{ data: Product[], success: boolean }> {
    return this.http.get<{ data: Product[], success: boolean }>(this.getProductsUrl);
  }
  deleteProducts(productIds: number[]): Observable<ApiResponse> {

    return this.http.post<ApiResponse>(this.deleteProductsUrl, productIds);
  }
}