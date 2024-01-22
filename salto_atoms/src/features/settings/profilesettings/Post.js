import React, { useEffect } from "react";
import { useRecoilState, useSetRecoilState } from "recoil";
import {
  selectedPostState,
  selectedDivisionState,
  isPostSelectedState,
} from "../../../state";
import useStrapi from "../../../hooks/useStrapi";

const Post = () => {
  const [selectedPostId, setSelectedPostId] = useRecoilState(selectedPostState);
  const [selectedDivisionId, setSelectedDivisionId] = useRecoilState(selectedDivisionState);
  const setIsPostSelected = useSetRecoilState(isPostSelectedState);
  const { data: postData } = useStrapi("posts", {});
  const { data: divisionData } = useStrapi("divisions", {});
  // pos_idが1, 2, 3の場合はDivisionを表示
  const isDivisionVisible = [1, 2, 3].includes(selectedPostId);

  useEffect(() => {
    // pos_idが0, 1, 2, 3の場合は部署を非活性にする
    const isDepartmentFormActive = [0, 1, 2, 3].includes(selectedPostId);
    setIsPostSelected(!isDepartmentFormActive);

    // 部署を非活性にする場合、selectedDivisionIdを0にリセット
    if (!isDepartmentFormActive) {
      setSelectedDivisionId(0);
    }
  }, [selectedPostId, setIsPostSelected, setSelectedDivisionId]);

  const handlePostChange = (e) => {
    const newId = parseInt(e.target.value, 10); // 数値に変換
    setSelectedPostId(newId);

    // pos_idが0 ,1, 2, 3以外の場合はDivision Formを活性にし、それ以外は非活性にする
    setIsPostSelected(![1, 2, 3].includes(newId));

    if ([0].includes(newId)) {
      setSelectedDivisionId(0);
    }
  };

  const handleDivisionChange = (e) => {
    setSelectedDivisionId(parseInt(e.target.value, 10)); // div_id も数値に変換
  };

  return (
    <div className="flex-1">
      {/* Post 選択 */}
      <label className="label" htmlFor="post">
        Post
      </label>
      <select
        id="post"
        className="select w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
        value={selectedPostId}
        onChange={handlePostChange}
      >
        <option value="0">Select Post</option>
        {postData?.data?.map((pos) => (
          <option key={pos.id} value={pos.id}>
            {pos.attributes.pos_name}
          </option>
        ))}
      </select>

      {/* Division Form */}
      {isDivisionVisible && (
        <div>
          <label className="label" htmlFor="division">
            Division
          </label>
          <select
            id="division"
            className="select w-full border border-gray-300 rounded-lg bg-slate-100 text-black"
            value={selectedDivisionId}
            onChange={handleDivisionChange}
          >
            <option value="0">Select Division</option>
            {divisionData?.data?.map((div) => (
              <option key={div.id} value={div.id}>
                {div.attributes.div_name}
              </option>
            ))}
          </select>
        </div>
      )}
    </div>
  );
};

export default Post;
