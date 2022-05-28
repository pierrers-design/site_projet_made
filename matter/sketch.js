// module aliases
var Engine = Matter.Engine,
  Render = Matter.Render,
  Runner = Matter.Runner,
  Bodies = Matter.Bodies,
  Composite = Matter.Composite;

// create an engine
var engine = Engine.create();

// create a renderer
var render = Render.create({
  element: document.body,
  engine: engine,
});

// react to the mouse
let mouse = Matter.Mouse.create(render.canvas);
let mouseConstraint = Matter.MouseConstraint.create(engine, {
  mouse: mouse,
  constraint: {
    render: { visible: false },
  },
});
render.mouse = mouse;

// create two boxes and a ground
var boxA = Bodies.rectangle(400, 200, 80, 80);
var boxB = Bodies.rectangle(450, 50, 80, 80);
var ceiling = Bodies.rectangle(400, 0, 810, 20, { isStatic: true });
var ground = Bodies.rectangle(400, 600, 810, 20, { isStatic: true });
var wallLeft = Bodies.rectangle(0, 300, 20, 810, { isStatic: true });
var wallRight = Bodies.rectangle(800, 300, 20, 810, { isStatic: true });

// add all of the bodies to the world
Matter.World.add(engine.world, [boxA, boxB, ceiling, ground, wallLeft, wallRight, mouseConstraint]);

// run the renderer
Render.run(render);

// create runner
var runner = Runner.create();

// run the engine
Runner.run(runner, engine);
