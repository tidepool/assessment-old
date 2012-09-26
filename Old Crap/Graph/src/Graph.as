package  
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.KeyboardEvent;
	/**
	 * ...
	 * @author Wei
	 */
	public class Graph 
	{
		
		public var main:Main;
		public var positionX:Number;
		public var positionY:Number;
		public var nodeData:Array = new Array();
		public var nodes:Array = new Array();
		public var adjMatrix:Array;
		public var root:int;
		public var rootNode:GraphNode;
		
		public var springFactor1:Number = 100;
		public var springLength1:Number = 150;
		public var springFactor2:Number = 100;
		public var springLength2:Number = 100;
		public var gFactor:Number = 3000000000;
		
		public var edgeSprite:Sprite = new Sprite();
		
		public function Graph(p_main:Main,px:Number,py:Number) 
		{
			main = p_main;
			positionX = px;
			positionY = py;
			createAllData();
			createAdjMat();
			addEdges1();
			
			root = 0;
			createGraph();
			main.addEventListener(Event.ENTER_FRAME, update);
			main.addChild(edgeSprite);
			main.stage.addEventListener(KeyboardEvent.KEY_DOWN, keyPressed);
		}
		
		public function update(e:Event):void
		{
			edgeSprite.graphics.clear();
			edgeSprite.graphics.beginFill(0);
			edgeSprite.graphics.lineStyle(1,0,1);
			for (var i:int = 0; i < nodes.length; i++ )
			{
				for (var j:int = 0; j < nodes[i].neighbors.length; j++ )
				{
					edgeSprite.graphics.moveTo(nodes[i].positionX, nodes[i].positionY);
					edgeSprite.graphics.lineTo(nodes[i].neighbors[j].positionX,nodes[i].neighbors[j].positionY);
				}
			}
			edgeSprite.graphics.endFill();
			
		}
		
		public function clear():void
		{
			for (var i:int = 0; i < nodes.length; i++ )
			{
				nodes[i].clear();
			}
			nodes.splice(0,nodes.length);
		}
		
		public function createGraph():void
		{
			rootNode = new GraphNode(main, this, positionX, positionY, nodeData[root],0);
			nodes.push(rootNode);
			createNeighbor(rootNode, 1);
			var len:int = nodes.length;
			for (var k:int = 1; k < len; k++ )
			{
				createNeighbor(nodes[k], 2);
			}
		
		}
		
		public function createNeighbor(rootNode:GraphNode,layer:int):void
		{
			var neibData:Array = getNeighbors(rootNode.name);
			for (var i:int = 0; i < neibData.length; i++ )
			{
				var n:GraphNode;
				var ch:GraphNode;
				ch = checkIsAdded(neibData[i]);
				if (layer == 1)
				{
					if (ch==null)
					{
						n = new GraphNode(main, this, rootNode.positionX + 250 * Math.sin(i * 1), rootNode.positionY + 200 * Math.cos(i * 1), neibData[i], layer);
						n.neighbors.push(rootNode);
						rootNode.neighbors.push(n);
						nodes.push(n);
					}
					else
					{
						ch.neighbors.push(rootNode);
						rootNode.neighbors.push(ch);
					}
				}
				else
				{
					if (ch==null)
					{
						n = new GraphNode(main, this, rootNode.positionX + 50 * Math.sin(i * 1), rootNode.positionY + 100 * Math.cos(i * 1), neibData[i],layer);
						n.neighbors.push(rootNode);
						rootNode.neighbors.push(n);
						nodes.push(n);
					}
					else
					{
						ch.neighbors.push(rootNode);
						rootNode.neighbors.push(ch);
					}
				}
				
			}
		}
		
		public function checkIsAdded(s:String):GraphNode
		{
			for (var i:int = 0; i < nodes.length; i++ )
			{
				if (nodes[i].name == s)
				{
					return nodes[i];
				}
			}
			return null;
		}
		
		public function createAdjMat():void
		{
			adjMatrix = new Array();
			for (var i:int = 0; i < nodeData.length; i++ )
			{
				for (var j:int = 0; j < nodeData.length; j++ )
				{
					adjMatrix.push(false);
				}
			}
		}
		
		public function addNodeData(s:String):void
		{
			nodeData.push(s);
		}
		
		public function addEdge(i:int, j:int):void
		{
			adjMatrix[j * nodeData.length + i] = true;
			adjMatrix[i * nodeData.length + j] = true;
		}
		
		public function getNeighbors(s:String):Array
		{
			var i:int = 0;
			for ( i = 0; i < nodeData.length; i++ )
			{
				if (s==nodeData[i])
				{
					break;
				}
			}
			var a:Array = new Array();
			for (var j:int = 0; j < nodeData.length; j++ )
			{
				if (adjMatrix[i * nodeData.length + j])
				{

					if (i != j)
					{
						a.push(nodeData[j]);
					}				
					
				}
			}
			return a;
		}
		
		public function keyPressed(e:Event):void
		{
			reset();
		}
		
		public function reset():void
		{
			clear();
			nodeData.splice(0, nodeData.length);
			adjMatrix.splice(0, adjMatrix.length);
			createAllData();
			createAdjMat();
			addEdges1();
			
			root = 0;
			createGraph();
		}
		
		public function reset1():void
		{
			clear();
			nodeData.splice(0, nodeData.length);
			adjMatrix.splice(0, adjMatrix.length);
			createAllData();
			createAdjMat();
			addEdges1();
			
			root = 0;
			createGraph();
		}
		
		public function createAllData():void
		{
			addNodeData("Emily");
			addNodeData("Mady");
			addNodeData("Daniel");
			addNodeData("Grace");
			addNodeData("Chris");
			
			addNodeData("John");
			addNodeData("Liz");
			addNodeData("Mike");
			addNodeData("Ryan");
			addNodeData("Natalie");
			
			addNodeData("Don");
			addNodeData("Lauren");
			addNodeData("Will");
			addNodeData("Sarah");
			addNodeData("Ted");
			
			addNodeData("Anna");
			addNodeData("Alexis");
			addNodeData("Jacob");
			addNodeData("Zachary");
			addNodeData("Brianna");
			
			addNodeData("Ben");
			addNodeData("Ethan");
			addNodeData("Kayla");
			addNodeData("Dylan");
			addNodeData("Sophia");
			
			addNodeData("Anthony");
			addNodeData("Natalie");
			addNodeData("Olivia");
			addNodeData("Andrew");
			addNodeData("Tyler");
		}
		
		public function addEdges2():void
		{
			addEdge(0, 1);
			addEdge(0, 2);
			addEdge(0, 3);
			
			addEdge(1, 2);
			addEdge(1, 3);
			addEdge(1, 4);
			
			addEdge(2, 3);
			addEdge(2, 4);
			
			addEdge(3, 4);
			
			addEdge(4, 5);
			addEdge(4, 6);
			addEdge(4, 7);
			addEdge(4, 8);
			addEdge(4, 9);
			addEdge(4, 10);
			addEdge(4, 11);
			addEdge(4, 12);
			
			addEdge(5, 6);
			addEdge(5, 7);
			addEdge(5, 8);
			addEdge(5, 9);
			addEdge(5, 10);
			addEdge(5, 11);
			addEdge(5, 12);
			
			addEdge(6, 7);
			addEdge(6, 8);
			addEdge(6, 9);
			addEdge(6, 10);
			addEdge(6, 11);
			addEdge(6, 12);
			
			addEdge(7, 8);
			addEdge(7, 9);
			addEdge(7, 10);
			addEdge(7, 11);
			addEdge(7, 12);
			
			addEdge(8, 9);
			addEdge(8, 10);
			addEdge(8, 11);
			addEdge(8, 12);
			
			addEdge(9, 10);
			addEdge(9, 11);
			addEdge(9, 12);
			
			addEdge(10, 11);
			addEdge(10, 12);
			addEdge(10, 13);
			addEdge(10, 14);
			addEdge(10, 15);
			addEdge(10, 16);
			
			addEdge(11, 12);
			addEdge(11, 13);
			addEdge(11, 14);
			addEdge(11, 15);
			addEdge(11, 16);
			
			addEdge(12, 13);
			addEdge(12, 14);
			addEdge(12, 15);
			addEdge(12, 16);
			
			addEdge(13, 14);
			addEdge(13, 15);
			addEdge(13, 16);
			addEdge(13, 17);
			addEdge(13, 18);
			addEdge(13, 19);
			
			addEdge(14, 15);
			addEdge(14, 16);
			addEdge(14, 17);
			addEdge(14, 18);
			addEdge(14, 19);
			
			addEdge(15, 16);
			addEdge(15, 17);
			addEdge(15, 18);
			addEdge(15, 19);
			
			addEdge(16, 17);
			addEdge(16, 18);
			addEdge(16, 19);
			
			addEdge(17, 18);
			addEdge(17, 19);
			addEdge(17, 20);
			addEdge(17, 21);
			addEdge(17, 22);
			addEdge(17, 23);
			addEdge(17, 24);
			
			addEdge(18, 19);
			addEdge(18, 20);
			addEdge(18, 21);
			addEdge(18, 22);
			addEdge(18, 23);
			addEdge(18, 24);
			
			
			addEdge(19, 20);
			addEdge(19, 21);
			addEdge(19, 22);
			addEdge(19, 23);
			addEdge(19, 24);
			
			addEdge(20, 21);
			addEdge(20, 22);
			addEdge(20, 23);
			addEdge(20, 24);
			addEdge(20, 25);
			addEdge(20, 26);
			
			addEdge(21, 22);
			addEdge(21, 23);
			addEdge(21, 24);
			addEdge(21, 25);
			addEdge(21, 26);
			
			addEdge(22, 23);
			addEdge(22, 24);
			addEdge(22, 25);
			addEdge(22, 26);
			
			addEdge(23, 24);
			addEdge(23, 25);
			addEdge(23, 26);
			
			addEdge(24, 25);
			addEdge(24, 26);
			
			addEdge(25, 26);
			addEdge(25, 27);
			
			addEdge(26, 27);
			
			addEdge(27, 28);
			
			addEdge(28, 29);
			
		}
		
		public function addEdges1():void
		{
			addEdge(0, 1);
			addEdge(0, 6);
			addEdge(0, 9);
			addEdge(0, 13);
			
			addEdge(1, 3);
			addEdge(1, 8);
			addEdge(1, 10);
			addEdge(1, 13);
			
			addEdge(2, 6);
			addEdge(2, 14);
			
			addEdge(3, 4);
			addEdge(3, 5);
			addEdge(3, 7);
			
			addEdge(4, 5);
			addEdge(4, 11);
			addEdge(4, 12);
			addEdge(4, 13);
			
			addEdge(5, 9);
			addEdge(5, 13);
			addEdge(5, 14);
		}
		
	}

}