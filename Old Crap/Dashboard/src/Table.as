package  
{
	import flash.display.Sprite;
	/**
	 * ...
	 * @author Wei
	 */
	public class Table 
	{
		public var main:Main;
		
		public var tableBG:picture;
		public var tablePic:picture;
		public var shouldSetindex:Boolean = false;
		public var tableData:Array = new Array();
		public var tableLabels:Array = new Array();
		public var tableHeadData:Array = new Array();
		public var tableHeadLabel:Array = new Array();
		public var tableWidth:int = 4;
		public var tableHeight:int = 12;
		public var tableX:Number = 770;
		public var tableY:Number = 160;
		public var marginX:Number = 200;
		public var marginY:Number = 48;
		public var frameSprite:Sprite = new Sprite();
		public var tableName:label;
		public function Table(p_main:Main) 
		{
			
			main = p_main;
			
			createTableData(tableWidth, tableHeight);
		//	generateData();
			showData();
			shouldSetindex = true;
			drawFrame();
		}
		
		public function changeData(data:Array):void
		{
			var a:int = tableHeight;
			if (data.length < a)
			{
				a = data.length;
			}
			for (var i:int = 0; i < tableHeight; i++ )
			{
				setTableData(0,i,"");
				setTableData(1,i,"");
				setTableData(2, i,"");
				setTableData(3, i,"");
			}
			for (var i:int = 0; i < a; i++ )
			{
				setTableData(0,i,data[i].name);
				setTableData(1,i,data[i].department);
				setTableData(2, i,data[i].position);
				setTableData(3, i,data[i].worktype);
			}
			
			showData();
		}
		
		
		public function drawFrame():void
		{
			main.addChild(frameSprite);
			
			frameSprite.graphics.lineStyle(2, 0, 1);
			frameSprite.graphics.beginFill(0x0000FF);
			frameSprite.graphics.drawRect(tableX-marginX/2,tableY-100,marginX*tableWidth,100-marginY/2);
			frameSprite.graphics.endFill();
			
			frameSprite.graphics.beginFill(0);
			
			for (var i:int=0; i < tableHeight+2; i++ )
			{
				frameSprite.graphics.moveTo(tableX-marginX/2, tableY-marginY/2+marginY*i);
				frameSprite.graphics.lineTo(tableX-marginX/2 + (marginX*tableWidth-1), tableY-marginY/2+marginY*i);
			}
			
			for ( i=0; i < tableWidth+1; i++ )
			{
				frameSprite.graphics.moveTo(tableX-marginX/2+marginX*i, tableY-marginY/2);
				frameSprite.graphics.lineTo(tableX-marginX/2+marginX*i , tableY-marginY/2+ (marginY*(tableHeight+1)));
			}
			
			frameSprite.graphics.endFill();
		}
		
		public function setTableIndex():void
		{
		}
		
		public function createTableData(x:int,y:int):void
		{
			tableHeadData.push("Name");
			tableHeadData.push("Department");
			tableHeadData.push("Position");
			tableHeadData.push("Worktype");
			tableHeadLabel.push(new label(main, 0, 0, ""));
			tableHeadLabel.push(new label(main, 0, 0, ""));
			tableHeadLabel.push(new label(main, 0, 0, ""));
			tableHeadLabel.push(new label(main, 0, 0, ""));
			tableLabels.push(new label(main, 0, 0, ""));
			tableLabels.push(new label(main, 0, 0, ""));
			tableLabels.push(new label(main, 0, 0, ""));
			tableLabels.push(new label(main, 0, 0, ""));
			
			for (var i:int = 0; i < x; i++ )
			{
				for (var j:int = 0; j < y; j++ )
				{
					tableLabels.push(new label(main,0,0,""));
					tableData.push("");
				}
			}
		}
		
		public function showData():void
		{
			for (var i:int = 0; i < tableWidth; i++ )
			{
				for (var j:int = 0; j < tableHeight; j++ )
				{
					tableLabels[j * tableWidth +i].changeText(tableX+i*marginX,tableY+(j+1)*marginY,20,getTableData(i,j));
				}
			}
			for ( i = 0; i < tableWidth; i++ )
			{
				tableHeadLabel[i].changeText(tableX + i * marginX, tableY, 20, tableHeadData[i]);
			}
		}
		
		public function generateData():void
		{
			setTableData(0,0,"Wei");
			setTableData(1,0,"Sales");
			setTableData(2, 0,(int)( Math.random()*20+79)+"");
			
			setTableData(0,1,"Kabir");
			setTableData(1,1,"IT");
			setTableData(2,1,(int)(Math.random()*20+79)+"");
			
			setTableData(0,2,"Rhett");
			setTableData(1,2,"Marketing");
			setTableData(2,2,(int)(Math.random()*20+79)+"");
			
			setTableData(0,3,"Galen");
			setTableData(1,3,"Accounting");
			setTableData(2,3,(int)(Math.random()*20+79)+"");
		}
		
		public function generateData1():void
		{
			setTableData(0,0,"We11i");
			setTableData(1,0,"Sales");
			setTableData(2, 0,(int)( Math.random()*20+79)+"");
			
			setTableData(0,1,"Kabir");
			setTableData(1,1,"IT");
			setTableData(2,1,(int)(Math.random()*20+79)+"");
			
			setTableData(0,2,"Rhett");
			setTableData(1,2,"Marketing");
			setTableData(2,2,(int)(Math.random()*20+79)+"");
			
			setTableData(0,3,"Galen");
			setTableData(1,3,"Accounting");
			setTableData(2,3,(int)(Math.random()*20+79)+"");
		}
		
		public function setTableData(x:int,y:int,s:String):void
		{
			tableData[y * tableWidth +x] = s;
		}
		
		public function getTableData(x:int,y:int):String
		{
			return tableData[y * tableWidth +x];
		}
		
	}

}