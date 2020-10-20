var canvas =document.getElementById("canvas");
/** @type {CanvasRenderingContext2D} */
var ctx=canvas.getContext('2d');
var height=canvas.height;
var width=canvas.width;
ball={
    r:50,
    x:50,
    y:50,
    dx:0.1,
    dy:0.1
};

ball.x=ball.r
ball.y=ball.r

function draw_ball(){
    ctx.clearRect(0,0,width,height);
    ctx.beginPath();
    ctx.arc(ball.x,ball.y,ball.r,0,2*Math.PI);
    ctx.fillStyle = "#0095DD";
    ctx.fill();
}

function update(){
    if(ball.x+ball.r>=width && ball.y-ball.r<=0){
        dy=10;
        dx=0;
    }else
    if(ball.y+ball.r>=height && ball.x+ball.r>=width){
        dx=-10;
        dy=0;
    }
    else
    if(ball.y-ball.r<=0){
        dx=10;
        dy=0;
    }else
    if(ball.x-ball.r<=0){
        dy=-10;
        dx=0;
    }
    ball.x+=dx;
    ball.y+=dy;
    console.log(ball.x,ball.y);
    
    draw_ball()
}

console.log("width "+width+"height"+height);
setInterval(update,2);
