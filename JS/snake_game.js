let display = [];
let viewPort;
let gameStatus = 'stopped';
let snake = {};
let food = {};
let gameTimer;
let gameSpeed = 1;
let renderIndex = 0;
let speedUpLimit = 25;
let onTick;

const rectStyles = [
  {
    id: 0,
    type: 'Background',
    stroke: 'rgb(25, 25, 25)',
    fill: 'rgb(15, 15, 15)'
  },
  {
    id: 1,
    type: 'Snake head',
    stroke: 'rgb(250, 250, 250)',
    fill: 'rgb(220, 220, 220)'
  },
  {
    id: 2,
    type: 'Snake body',
    stroke: 'rgb(200, 200, 200)',
    fill: 'rgb(180, 180, 180)'
  },
  {
    id: 3,
    type: 'Food',
    stroke: 'rgb(250, 250, 0)',
    fill: 'rgb(230, 230, 0)'
  }
]

function createDisplay(width=15, height=15) {
  for(let w=0; w<width; w++) {
    for(let h=0; h<height; h++) {
      if( !display[ h ] )
        display[ h ] = [];
      
      display[ h ][ w ] = {
        h: h,
        w: w,
        id: 0,
        type: 0
      };
    }
  }
}

function clearDisplay() {
  for(let h=0; h<display.length; h++)
    for(let w=0; w<display[ 0 ].length; w++)
      display[ h ][ w ].type = 0;
}

function render(element) {
  let ctx = element.getContext('2d');
  
  ctx.canvas.width = ctx.canvas.clientWidth;
  ctx.canvas.height = ctx.canvas.clientHeight;
  
  let rectWidth = parseInt(ctx.canvas.width / display[ 0 ].length - 1);
  let rectHeight = parseInt(ctx.canvas.height / display.length - 1);
  
  for(let h=0; h<display.length; h++)
    for(let w=0; w<display[ h ].length; w++) {
      let left = w * rectWidth + w;
      let top = h * rectHeight + h;
      
      ctx.strokeStyle = rectStyles[ display[ h ][ w ].type ].fill;
      ctx.fillStyle = rectStyles[ display[ h ][ w ].type ].stroke;
      
      ctx.fillRect(left, top, rectWidth, rectHeight);
      ctx.strokeRect(left, top, rectWidth, rectHeight);
    }
}

function getRandomIntInclusive(min, max) {
  min = Math.ceil(min);
  max = Math.floor(max);
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function createFood() {
  let emptyRects = [];
  for(let h=0; h<display.length; h++)
    for(let w=0; w<display[ 0 ].length; w++)
      if( display[ h ][ w ].type == 0 )
        emptyRects.push(display[ h ][ w ]);
  
  let foodRect = emptyRects[ getRandomIntInclusive(0, emptyRects.length-1) ];
  
  return {
    x: foodRect.w,
    y: foodRect.h,
    type: 1
  }
}

function createSnake() {
  return {
    xDir: 0,
    yDir: 0,
    sections: [
      {
        x: parseInt(display[ 0 ].length / 2),
        y: parseInt(display.length / 2)
      }
    ]
  }
}

function leftPress() {
  snake.xDir = -1;
  snake.yDir = 0
}

function rightPress() {
  snake.xDir = 1;
  snake.yDir = 0;
}

function upPress() {
  snake.yDir = -1;
  snake.xDir = 0;
}

function downPress() {
  snake.yDir = 1;
  snake.xDir = 0;
}

function escPress() {
  if( gameStatus === 'game' ) {
    gameStatus = 'paused';
    return;
  }
  
  if( gameStatus === 'paused' ) {
    gameStatus = 'game';
    return;
  }
}

const keyMap = {
  'Escape': escPress,
  'KeyD': rightPress,
  'KeyA': leftPress,
  'KeyW': upPress,
  'KeyS': downPress
}

function setKeyEvents() {
  document.addEventListener('keydown', function(event) {
    if( gameStatus == 'stopped' ) return;
    
    if( keyMap[ event.code ] ) { 
      event.stopPropagation();
      keyMap[ event.code ]();
    }
  });
}

function gameOver(endType) {
  clearInterval(gameTimer);
  gameStatus = 'stopped';
}

function setSnakeOnDisplay() {
  display[ snake.sections[ 0 ].y ][ snake.sections[ 0 ].x ].type = 1;
  if( snake.sections.length > 1 )
    for(let index=1; index<snake.sections.length; index++)
      display[ snake.sections[ index ].y ][ snake.sections[ index ].x ].type = 2;
}

function renderSnake() {
  let head = snake.sections[ 0 ];
  let headNewX = snake.xDir + head.x;
  let headNewY = snake.yDir + head.y;
  
  if( headNewX < 0 ) return gameOver('crash');
  if( headNewY < 0 ) return gameOver('crash');
  if( headNewX >= display[ 0 ].length ) return gameOver('crash');
  if( headNewY >= display.length ) return gameOver('crash');
  
  if( snake.sections.length > 1 )
    for(let index=1; index<snake.sections.length; index++)
      if( (headNewX === snake.sections[ index ].x) && (headNewY === snake.sections[ index ].y) )
        return gameOver('Bite');
  
  if( (food.x === headNewX) && (food.y === headNewY ) ) {
    let newSections = [ { x: headNewX, y: headNewY }];
    for(let section of snake.sections)
      newSections.push(section);
    
    snake.sections = newSections;
    food = createFood();
    
    return setSnakeOnDisplay();
  }
  
  let newCoords = {
    x: headNewX,
    y: headNewY
  }  
  
  for(let index=0; index<snake.sections.length; index++) {
    let tmp = Object.assign({}, snake.sections[ index ]);
    snake.sections[ index ] = Object.assign({}, newCoords);
    newCoords = tmp;    
  }

  setSnakeOnDisplay();
}

function renderFood() {
  display[ food.y ][ food.x ].type = 3;
}

function tick() {
  if( gameStatus !== 'game' ) return; 
  renderIndex ++;
  if( renderIndex > speedUpLimit  ) {
    renderIndex =0;
    //gameSpeed ++;
    clearInterval(gameTimer);
    gameTimer = setInterval(tick, 1000 - (gameSpeed * 50));
  }
  
  clearDisplay();
  renderFood();
  renderSnake();
  render(viewPort);
  
  if( onTick ) onTick();
}

function initGame(container) {
  gameStatus = 'stopped';
  gameSpeed = 10;
  createDisplay();
  viewPort = container;
  render(viewPort);
  setKeyEvents();
}

function pauseGame() {
    if( gameStatus === 'game' ) {
        gameStatus = 'paused';
        return;
      }
}

function resumeGame() {
    if( gameStatus === 'paused' ) {
        gameStatus = 'game';
        return;
      }
}

function startGame(onTickHandler) {
  snake = createSnake();
  food = createFood();
  gameStatus = 'game';
  onTick = onTickHandler;
  gameTimer = setInterval(tick, 1000 - (gameSpeed * 50));
}
