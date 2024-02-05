export interface Product {
    id: number;
    sku: string;
    name: string;
    price: string;
    type: string;
    size?: string;
    weight?: string;
    dimensions?: {
        height?: string;
        width?: string;
        length?: string;
    };

}
export interface ApiResponse {
    success: boolean;
    data: Product[];

}
