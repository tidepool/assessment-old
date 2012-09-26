package 
{
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.media.Video;
	import flash.net.URLLoader;
	import flash.net.URLRequest;
	import flash.external.*;

	/**
	 * ...
	 * @author Wei
	 */
	public class Main extends Sprite 
	{
		public var tableBG:picture;
		public var tablePic:picture;
		public var shouldSetindex:Boolean = false;
		public var tableData:Array = new Array();
		public var tableLabels:Array = new Array();
		public var tableHeadData:Array = new Array();
		public var tableHeadLabel:Array = new Array();
		public var tableWidth:int = 3;
		public var tableHeight:int = 4;
		public var tableX:Number = 670;
		public var tableY:Number = 230;
		public var marginX:Number = 150;
		public var marginY:Number = 50;
		public var okButton:picture;
		public var frameSprite:Sprite = new Sprite();
		public var tableName:label;
		
		
		public var xmlString:XML;
		
		public var barC:barChart;
		public function Main():void 
		{
			if (stage) init();
			else addEventListener(Event.ADDED_TO_STAGE, init);
		}
		
		public function GetXML(data):void
		{
			xmlString = new XML(data);
			trace(xmlString);
			
			new label(this,150,50,"Personality");
			new label(this,900,50,"Holland");
			new label(this,150,400,"Value");
			new label(this,900,400,"Attachment");
			new personalityChart(this, 200, 200);
			new piechart(this,1);
			new piechart(this, 2);
			
		
			barC = new barChart(this);
			barC.addBar(xmlString.children()[3].children()[0], "Secure");
			barC.addBar(xmlString.children()[3].children()[1], "Anxious avoident");
			barC.addBar(xmlString.children()[3].children()[2], "Dismissive avoident");
			barC.addBar(xmlString.children()[3].children()[3],"Fearful avoident");
			barC.drawBars();
			tableName = new label(this, 0, 0, "");
			
		}
		
		private function init(e:Event = null):void 
		{
			removeEventListener(Event.ADDED_TO_STAGE, init);
			addEventListener(Event.ENTER_FRAME, update);
			// entry point
		
			 if (ExternalInterface.available) 
			 {
                try 
				{
					ExternalInterface.addCallback("sendToActionScript", GetXML);
				} 
				catch (error:SecurityError) 
				{                    
					//result.changeText(400, 200, 35, "Result2 is: "+error.message);
                } 
				catch (error:Error) 
				{
					//result.changeText(400, 200, 35, "Result3 is: "+error.message);
                }
			 }
			 else
			 {
				var tempString:String = "<results>";
				tempString += "<holland><artistic>87</artistic><conventional>5</conventional><enterprising>9</enterprising><investigative>25</investigative><realistic>46</realistic><social>4</social></holland>";
				tempString += "<personality><conscientiousness>65</conscientiousness><agreeableness>5</agreeableness><extroversion>27</extroversion><neuroticism>85</neuroticism><openness>68</openness></personality>";
				tempString += "<values><achievement>65</achievement><challenge>5</challenge><independence>27</independence><money>27</money><power>85</power><recognition>68</recognition><service>65</service><variety>5</variety></values>";
				tempString += "<attachment><Secure>87</Secure><Anxious>5</Anxious><Dismissive>9</Dismissive><Fearful>25</Fearful></attachment></results>";
				//GetXML(tempString);
			 }
		}
		
		public function update(e:Event):void
		{
			if (shouldSetindex)
			{
				setTableIndex();
			}
		}
		
		public function popWindow(s:String):void
		{
			tableName.changeText(800, 165, 30, s);
			tableName.text.textColor = 0xFFFFFF;
			tableBG = new picture(this, 800, 400, "assets/DimensionCharts/windowBG.png", 2500);
			tableBG.sprite.alpha = 0.9;
			tablePic=new picture(this, 800, 400, "assets/DimensionCharts/window.png", 600);
			//var tabelSprite:Sprite = new Sprite();
			createTableData(tableWidth, tableHeight);
			generateData();
			showData();
			shouldSetindex = true;
			okButton = new picture(this,800,600,"assets/DimensionCharts/nextButton.png",163);
			okButton.sprite.addEventListener(MouseEvent.CLICK, hideWindow);
			drawFrame();
		}
		
		public function hideWindow(e:Event=null):void
		{
			tableName.changeText(0,0,10,"");
			if(contains(tableBG.sprite))
				removeChild(tableBG.sprite);
			if(contains(tablePic.sprite))
				removeChild(tablePic.sprite);
			for (var i:int = 0; i < tableLabels.length; i++ )
			{
				removeChild(tableLabels[i].sprite);
			}
			for ( i = 0; i < tableHeadLabel.length; i++ )
			{
				removeChild(tableHeadLabel[i].sprite);
			}
			tableHeadData.splice(0, tableHeadData.length);
			tableHeadLabel.splice(0, tableHeadLabel.length);
			tableLabels.splice(0, tableLabels.length);
			tableData.splice(0, tableData.length);
			removeChild(okButton.sprite);
			if (contains(frameSprite))
			{
				removeChild(frameSprite);
			}
		}
		
		public function drawFrame():void
		{
			addChild(frameSprite);
			
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
			if (contains(tableBG.sprite)&&contains(tablePic.sprite))
			{
				setChildIndex(tableBG.sprite, numChildren - 1);
				setChildIndex(tablePic.sprite, numChildren - 1);
				for (var i:int = 0; i < tableLabels.length; i++ )
				{
					if (!contains(tableLabels[i].sprite))
					{
						return;
					}
				}
				for ( i = 0; i < tableLabels.length; i++ )
				{
					setChildIndex(tableLabels[i].sprite,numChildren-1);
				}
				for ( i = 0; i < tableHeadLabel.length; i++ )
				{
					setChildIndex(tableHeadLabel[i].sprite,numChildren-1);
				}
				if (!contains(okButton.sprite))
				{
					return;
				}
				if (contains(frameSprite))
				{
					setChildIndex(frameSprite,numChildren-1);
				}
				setChildIndex(okButton.sprite, numChildren - 1);
				setChildIndex(tableName.sprite,numChildren-1);
				shouldSetindex = false;
			}
			else
			{
				return;
			}
		}
		
		public function createTableData(x:int,y:int):void
		{
			tableHeadData.push("Name");
			tableHeadData.push("Department");
			tableHeadData.push("Score");
			tableHeadLabel.push(new label(this, 0, 0, ""));
			tableHeadLabel.push(new label(this, 0, 0, ""));
			tableHeadLabel.push(new label(this, 0, 0, ""));
			tableLabels.push(new label(this, 0, 0, ""));
			tableLabels.push(new label(this, 0, 0, ""));
			tableLabels.push(new label(this, 0, 0, ""));
			
			for (var i:int = 0; i < x; i++ )
			{
				for (var j:int = 0; j < y; j++ )
				{
					tableLabels.push(new label(this,0,0,""));
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