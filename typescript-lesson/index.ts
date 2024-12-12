import { LazyResult } from "postcss";

let hasValue = true;
let count = 10;
let float = 3.14;
let negative = -0.12;
let single = 'hello';
let double = "hello";

const person:{
    name: string;  
    age: number;
} = {
    name: 'Jack',
    age: 21 
}

const fuits: string[] = ['Apple', 'Banana', 'Grape']; 
const book: [string, number, boolean] = ['business', 1500, false];  

enum CofeeSize {
    SHORT = 'SHORT',
    TALL = 'TALL',
    GRANDE = 'GRANDE',
    VENTI = 'VENTI' 
}

const coffee = {
    hot: true,
    size: CofeeSize.TALL
}

coffee.size = CofeeSize.SHORT;
console.log(coffee.size);

let unionType: number | string = 10;
unionType = 'hello';

let unionTypes: (number | string)[] = [21, 'hello'];