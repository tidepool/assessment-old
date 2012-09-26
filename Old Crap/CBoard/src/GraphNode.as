package  
{
	import flash.events.Event;
	import flash.events.MouseEvent;
	/**
	 * ...
	 * @author Wei
	 */
	public class GraphNode 
	{
		public var main:Object;
		public var graph:Graph;
		public var positionX:Number;
		public var positionY:Number;
		public var pic:Picture;
		public var mask:Picture;
		public var lab:Label;
		public var layer:int = 0;
		public var name:String=new String();
		
		public var velocityX:Number=0;
		public var velocityY:Number=0;
		
		public var accelerationX:Number=0;
		public var accelerationY:Number=0;
		
		public var forceX:Number=0;
		public var forceY:Number=0;
		
		public var mass:Number = 1000;
		
		public var neighbors:Array = new Array();
		public var universe:Array;
		public var dampingFactor:Number = 1000;
		
		public var timer:int = 60;
		public var isDragging:Boolean = false;
		public var startX:Number;
		public var startY:Number;
		
		public var forceLimit:Number = 3000;
		public var speedLimit:Number = 7000;
		public var neiborForceLimit:Number = 10;
		
		public var lastPx:Number;
		public var lastPy:Number;
		public var lastFx:Number;
		public var lastFy:Number;
		public var lastVx:Number;
		public var lastVy:Number;
		
		public var vibratingParameter:Number=1000000000;
		
		public function GraphNode(p_main:Object,p_graph:Graph,px:Number,py:Number,p_name:String="tyj",p_layer:int=0) 
		{
			main = p_main;
			graph = p_graph;
			positionX = px;
			positionY = py;
			name = p_name;
			layer = p_layer;
			main.addEventListener(Event.ENTER_FRAME, update);
			if (layer == 0)
			{
				pic = new Picture(main, positionX, positionY, "assets/circle.png", 50);
			}
			else if (layer == 1)
			{
				pic = new Picture(main, positionX, positionY, "assets/circle1.png", 50);
			}
			else if (layer == 2)
			{
				pic = new Picture(main, positionX, positionY, "assets/circle2.png", 50);
			}
			lab = new Label(main,positionX,positionY,name,15);
			universe = graph.nodes;
			pic.sprite.addEventListener(MouseEvent.MOUSE_OVER, over);
			pic.sprite.addEventListener(MouseEvent.MOUSE_OUT, out);
			pic.sprite.addEventListener(MouseEvent.MOUSE_DOWN, mouseDown);
			pic.sprite.addEventListener(MouseEvent.MOUSE_UP, mouseUp);
		}
		
		public function mouseDown(e:Event):void
		{
			isDragging = true;
			pic.sprite.startDrag();
			startX = positionX;
			startY = positionY;
		//	main.isNodeDragging = true;
		}
		
		public function over(e:Event):void
		{
		//	main.redrawBar();
			graph.page.showPopup(positionX,positionY,name);
		}
		
		public function out(e:Event):void
		{
		//	main.redrawBar();
			graph.page.hidePopup();
		}
		
		public function mouseUp(e:Event=null):void
		{
			var distance:Number = Math.sqrt((positionX-startX)*(positionX-startX)+(positionY-startY)*(positionY-startY));
			if (distance < 3)
			{
				click();
			}
			isDragging = false;
		//	main.isNodeDragging = false;
			pic.sprite.stopDrag();
		}
		
		public function click(e:Event=null):void
		{
			
			graph.clear();
			var index:int = 0;
			for (var i:int = 0; i < graph.nodeData.length; i++ )
			{
				if (name == graph.nodeData[i])
				{
					index = i;
					break;
				}
			}
			graph.root = index;
			graph.createGraph();
		}
		
		public function clear():void
		{
			main.removeEventListener(Event.ENTER_FRAME, update);
			if (main.contains(lab.sprite))
			{
				main.removeChild(lab.sprite);
			}
			if (main.contains(pic.sprite))
			{
				main.removeChild(pic.sprite);
			}
		}
		
		public function update(e:Event):void
		{
			if (main.contains(lab.sprite))
			{
			//	main.setChildIndex(lab.sprite,main.numChildren-1);
			}
			if (isDragging)
			{
				positionX = pic.getPosition().x;
				positionY = pic.getPosition().y;
				
				if (positionX< graph.positionX||positionX> graph.positionX+graph.width||positionY< graph.positionY||positionY> graph.positionY+graph.height)
				{
					pic.sprite.stopDrag();
					isDragging = false;
				}
			}
			else
			{
				timer--;
				physicsStep();
				physicsStep();
			}
			
			pic.setPosition(positionX, positionY);
			lab.changeText(positionX - 5, positionY - 35, 15, name);
			
		}
		
		public function physicsStep():void
		{
			calculateForce();
			
			lastFx = forceX;
			lastFy = forceY;
			
			if (forceX > forceLimit)
			{
				forceX = forceLimit;
			}
			if (forceX < -forceLimit)
			{
				forceX = -forceLimit;
			}
			
			if (forceY > forceLimit)
			{
				forceY = forceLimit;
			}
			if (forceY < -forceLimit)
			{
				forceY = -forceLimit;
			}
			
			accelerationX = forceX / mass;
			accelerationY = forceY / mass;
			velocityX += accelerationX;
			velocityY += accelerationY;
			
			
			
			if (velocityX * forceX < 0||forceX*lastVx<0)
			{
				lastVx = velocityX;
				velocityX = velocityX/vibratingParameter;
			}
			if (velocityY * forceY < 0||forceY*lastVy<0)
			{
				lastVy = velocityY;
				velocityY = velocityY/vibratingParameter;
			}
			
			
			if (velocityX > speedLimit)
			{
				velocityX = speedLimit;
			}
			if (velocityX < -speedLimit)
			{
				velocityX = -speedLimit;
			}
			if (velocityY > speedLimit)
			{
				velocityY = speedLimit;
			}
			if (velocityY < -speedLimit)
			{
				velocityY = -speedLimit;
			}
			
			
			
			
			positionX += velocityX;
			positionY += velocityY;
			
			lastPx = positionX;
			lastPy = positionY;
			if (positionX < graph.positionX)
			{
				forceX = (graph.positionX - positionX) * 100000;
				positionX = graph.positionX;
			}
			if (positionX > graph.positionX+graph.width)
			{
				forceX = (-(graph.positionX+graph.width) + positionX) * 100000;
				positionX = graph.positionX+graph.width;
			}
			if (positionY < graph.positionY)
			{
				forceY = (graph.positionY - positionY) * 100000;
				positionY = graph.positionY;
			}
			if (positionY > graph.positionY+graph.height)
			{
				forceY = (-(graph.positionY+graph.height) + positionY) * 100000;
				positionY = graph.positionY+graph.height;
			}
			
		}
		
		public function calculateForce():void
		{
			forceX = 0;
			forceY = 0;
			for (var i:int = 0; i < neighbors.length; i++ )
			{
				calculateNeighborForce(neighbors[i]);
			}
			for ( i = 0; i < graph.nodes.length; i++ )
			{
				if(graph.nodes[i]!=this)
				calculateGForce(graph.nodes[i]);
			}
			calculateDamping();
		}
		
		public function calculateGForce(n:GraphNode):void
		{
			var offsetX:Number = n.positionX - positionX;
			var offsetY:Number = n.positionY - positionY;
			var offset:Number = Math.sqrt(offsetX * offsetX + offsetY * offsetY);
			var force:Number=0 ;
			force =  -graph.gFactor / offset / offset / offset;
			
			forceX += force / offset * offsetX;
			forceY += force / offset * offsetY;
		}
		
		public function calculateDamping():void
		{
			forceX += -velocityX * dampingFactor;
			forceY += -velocityY * dampingFactor;
		}
		
		public function calculateNeighborForce(n:GraphNode):void
		{
			var offsetX:Number = n.positionX - positionX;
			var offsetY:Number = n.positionY - positionY;
			var offset:Number = Math.sqrt(offsetX * offsetX + offsetY * offsetY);
			var force:Number ;
			if (this.layer == 0 || n.layer == 0)
			{
				force =  (offset - graph.springLength1) * graph.springFactor1;
			}
			else
			{
				force =  (offset - graph.springLength2) * graph.springFactor2;
			}
			
			
			forceX += force / offset * offsetX;
			forceY += force / offset * offsetY;
		}
		
	}

}