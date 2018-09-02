// Let and const are "blocks" scope.
// That mean

function testing(){
	let foo = 3;
	const bar = 3;
	if(true){
		let foo = 2;// 
		const bar = 4;// This is accepted as we are inside other scope thanks to the "if"
		console.log(foo);// 2
		console.log(bar); // 4
	}
	console.log(foo);// 3
	console.log(bar); //3
	
}
