import React from "react";
import { Excalidraw, WelcomeScreen, Sidebar, Footer, convertToExcalidrawElements } from "@excalidraw/excalidraw";
import { serializeAsJSON } from "@excalidraw/excalidraw";
import { parseMermaidToExcalidraw } from "@excalidraw/mermaid-to-excalidraw";


  
function ExcalidrawApp(){

    const UIOptions = {
        welcomeScreen: true,
        canvasActions: {
            saveAsImage: true,
            changeViewBackgroundColor: true,
            clearCanvas: true,
            loadScene: true,
            export: {
                saveFileToDisk: true,
            }
        },
      };

    //   // currently the elements returned from the parser are in a "skeleton" format
    //   // which we need to convert to fully qualified excalidraw elements first

    return (
        <>
            <div style={{ height: "500px" }}>
                <Excalidraw 
                    UIOptions={UIOptions}
                >  
                    <WelcomeScreen>
                        <WelcomeScreen.Hints.MenuHint>
                        </WelcomeScreen.Hints.MenuHint>
                        <WelcomeScreen.Hints.ToolbarHint />
                        <WelcomeScreen.Hints.HelpHint />
                        <WelcomeScreen.Center>
                            <WelcomeScreen.Center.Logo />
                            <WelcomeScreen.Center.Heading>
                            All your data is saved locally in the browser.
                            </WelcomeScreen.Center.Heading>
                            <WelcomeScreen.Center.Menu>
                            
                            <WelcomeScreen.Center.MenuItemHelp />
                            </WelcomeScreen.Center.Menu>
                        </WelcomeScreen.Center>
                    </WelcomeScreen>
                   
        
                </Excalidraw>         
            </div>
        </>
    )
}

export default ExcalidrawApp
