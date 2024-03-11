import Lottie from "lottie-react";
import ErrorAnimation from "../../assets/lottie/loading.json"; 

function Loading() {
  return (
    <div className="flex justify-center items-center mt-20">
       <div style={{ width: '400px', height: '400px', margin: '0 auto' }}>
          <Lottie animationData={ErrorAnimation} />
        </div>
    </div>
  );
}

export default Loading;
