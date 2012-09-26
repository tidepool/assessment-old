package  
{
	import flash.display.ActionScriptVersion;
	/**
	 * ...
	 * @author Wei
	 */
	public class GraphData 
	{
		public var users:Array;
		public var personalityThreshHold:Number = 2;
		public var graph:Graph;
		public function GraphData(user:Array,p_graph:Graph) 
		{
			users = user;
			graph = p_graph;
			createNode();
			createAdjMat();
			createEdges();
		}
		
		public function createNode():void
		{
			for (var i:int = 0; i < users.length; i++ )
			{
				if (users[i].name == null)
				{
					graph.addNodeData(" ");
				}
				else
				{
					graph.addNodeData(users[i].name);
				}
			}
		}
		
		public function createAdjMat():void
		{
			graph.adjMatrix = new Array();
			for (var i:int = 0; i < users.length; i++ )
			{
				for (var j:int = 0; j < users.length; j++ )
				{
					graph.adjMatrix.push(false);
				}
			}
		}
		
		public function createEdges():void
		{
			for (var i:int = 0; i < users.length; i++ )
			{
				for (var j:int = 0; j < users.length; j++ )
				{
					if (checkPersonality(users[i].frames, users[j].frames))
					{
						addEdge(i,j);
					}
				}
			}
		}
		
		public function checkPersonality(a:Array,b:Array):Boolean
		{
			var counter:int = 0;
			for (var i:int = 0; i < a.length; i++ )
			{
				if (isClose(a[i], b[i]))
				{
					counter++;
				}
			}
			if (counter > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function isClose(a:Number,b:Number):Boolean
		{
			if (a - b < personalityThreshHold && b - a < personalityThreshHold)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		
		public function addEdge(i:int, j:int):void
		{
			graph.adjMatrix[j * users.length + i] = true;
			graph.adjMatrix[i * users.length + j] = true;
		}
		
		
	}

}