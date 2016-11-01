var renderer, scene, camera, mesh;

init();

function init(){
    // on initialise le moteur de rendu
    renderer = new THREE.WebGLRenderer();

    // si WebGL ne fonctionne pas sur votre navigateur vous pouvez utiliser le moteur de rendu Canvas à la place
    // renderer = new THREE.CanvasRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.getElementById('container').appendChild(renderer.domElement);

    // on initialise la scène
    scene = new THREE.Scene();

    // on initialise la camera que l’on place ensuite sur la scène
    camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 1, 10000);
    camera.position.set(0, 0, 1000);
    scene.add(camera);

    // on créé un  cube au quel on définie un matériau puis on l’ajoute à la scène
    // var geometry = new THREE.CubeGeometry( 200, 200, 200 );
    // var material = new THREE.MeshBasicMaterial( { color: 0xff0000, wireframe: true } );
    // mesh = new THREE.Mesh( geometry, material );
    // scene.add( mesh );

    // var geometry = new THREE.BoxGeometry( 1, 1, 1 );
    // var material = new THREE.MeshBasicMaterial( { color: 0x00ff00 } );
    // var cube = new THREE.Mesh( geometry, material );
    // scene.add( cube );
    var geometry = new THREE.SphereGeometry( 200, 32, 32 );
    var material = new THREE.MeshBasicMaterial( {
        map: THREE.ImageUtils.loadTexture('metal.jpg', THREE.SphericalReflectionMapping), overdraw: true
    } );
    mesh = new THREE.Mesh( geometry, material );
    scene.add( mesh );

    var rightEyeGeometry = new THREE.CircleGeometry( 20, 32 );
    var rightEyeMaterial = new THREE.MeshBasicMaterial( { color: 0xffff00 } );
    var rightEye = new THREE.Mesh( rightEyeGeometry, rightEyeMaterial );
    rightEye.position.set(-60,60,200);
    scene.add( rightEye );

    var leftEyeGeometry = new THREE.CircleGeometry( 20, 32 );
    var leftEyeMaterial = new THREE.MeshBasicMaterial( { color: 0xffff00 } );
    var leftEye = new THREE.Mesh( rightEyeGeometry, rightEyeMaterial );
    leftEye.position.set(60,60,200);
    scene.add( leftEye );

    // on ajoute une lumière blanche
    var lumiere = new THREE.DirectionalLight( 0xffffff, 1.0 );
    lumiere.position.set( 0, 0, 400 );



    var curve = new THREE.QuadraticBezierCurve(
        new THREE.Vector3( -10, 0, 0 ),
        new THREE.Vector3( 20, 15, 0 ),
        new THREE.Vector3( 10, 0, 0 )
    );

    var path = new THREE.Path( curve.getPoints( 50 ) );

    var geometry = path.createPointsGeometry( 50 );
    var material = new THREE.LineBasicMaterial( { color : 0xff0000 } );

    //Create the final Object3d to add to the scene
    var curveObject = new THREE.Line( geometry, material );
    curveObject.position.set( 0, 0, 300 );
    scene.add( curveObject );

    function render() {
        requestAnimationFrame( render );
        //mesh.rotation.x += 0.01;
        //mesh.rotation.y += 0.01;
        renderer.render( scene, camera );
    }
    render();
}