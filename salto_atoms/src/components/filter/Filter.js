import React, { useState, useEffect } from "react";
import FunnelIcon from "@heroicons/react/24/outline/FunnelIcon";
import SearchBar from "../Input/SearchBar";

const Filter = ({ removeFilter, applyFilter, applySearch, posts, departments }) => {
  const [searchText, setSearchText] = useState("");

  const showFiltersAndApply = (param) => {
    setSearchText(param); 
    applyFilter(param);
  };

  useEffect(() => {
    const handleSearch = () => {
      if (searchText === "") {
        removeFilter();
      } else {
        applySearch(searchText);
      }
    };

    handleSearch();
  }, [searchText]); 
  

  return (
    <div className="inline-block float-right">
      <SearchBar
        searchText={searchText}
        setSearchText={setSearchText}
        styleClass="mr-4"
      />
      <div className="dropdown dropdown-bottom dropdown-end">
        <label tabIndex={0} className="btn btn-sm btn-outline">
          <FunnelIcon className="w-5 mr-2" />
          Filter
        </label>
        <ul
          tabIndex={0}
          className="dropdown-content menu p-2 text-sm shadow bg-base-100 rounded-box w-52"
        >
          <li className="menu-title"><span>Posts</span></li>
          {posts.map((post, index) => (
            <li key={index}><a onClick={() => showFiltersAndApply(post)}>{post}</a></li>
          ))}
          <li className="menu-title"><span>Departments</span></li>
          {departments.map((department, index) => (
            <li key={index}><a onClick={() => showFiltersAndApply(department)}>{department}</a></li>
          ))}
        </ul>
      </div>
    </div>
  );
};

export default Filter;
