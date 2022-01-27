const obj = {"61f190e7478a8601998304jpg":{"imgPath":"pictures\/61f190e7478a86.01998304.jpg","imgSize":281114781,"imgName":"MG_1_1_New_York_City-1.jpg"},"61f190e74c923498524269jpg":{"imgPath":"pictures\/61f190e74c9234.98524269.jpg","imgSize":492924,"imgName":"Central-Park-Manhattan-New-York-City-apartment.jpg"},"61f190e750834258031195jpg":{"imgPath":"pictures\/61f190e7508342.58031195.jpg","imgSize":1908750,"imgName":"Broadway,-New-York_GettyImages-588653038.jpg"},"61f190e75e9de088075785jpg":{"imgPath":"pictures\/61f190e75e9de0.88075785.jpg","imgSize":873791,"imgName":"iStock_000040849990_Large.jpg"}}

console.log(Object.keys(obj).length)
const objSorted = {};
let keyArray = [];
while (Object.keys(objSorted).length !== Object.keys(obj).length){
    let currentLowest = 10000000000;
    for (const [key, value] of Object.entries(obj)){
        if(!keyArray.includes(key)){
            if(value.imgSize < currentLowest){
                currentLowest = value.imgSize;
                currentValue = value;
                currentKey = key;
            }
        }
    }
    keyArray.push(currentKey)
    objSorted[currentKey] = currentValue;
}
console.log(objSorted)

