import * as React from "react";

type ProjectScreenshotProps = {
    image: string
}

export const ProjectScreenshot = (props: ProjectScreenshotProps) => {
    return(
        <div className="p-16 bgr-red-500">
            <div className="p-12 h-full w-full rounded-lg bg-light">
                <img className="p-8 rounded-lg object-fill" src={`${window.location.protocol}/uploads/images/${props.image}`} alt=""/>
            </div>
        </div>
    )


}