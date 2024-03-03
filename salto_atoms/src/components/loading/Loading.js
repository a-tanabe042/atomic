import Lottie from "lottie-react";
import ErrorAnimation from "../../assets/lottie/loading.json"; 

function Loading() {
  return (
    <div className="flex justify-center items-center">
       <div style={{ width: '300px', height: '300px', margin: '0 auto' }}>
          <Lottie animationData={ErrorAnimation} />
        </div>
    </div>
  );
}

export default Loading;
