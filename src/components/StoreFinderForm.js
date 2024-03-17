import { SelectControl } from '@wordpress/components';
import React from 'react';
export const StoreFinderForm = ({ attributes, setAttributes }) => {
  const { selectVal } = attributes;
  return (
    <div>
      <SelectControl
        label="Size"
        value={selectVal}
        options={[
          { label: 'Big', value: '100%' },
          { label: 'Medium', value: '50%' },
          { label: 'Small', value: '25%' },
        ]}
        onChange={val => setAttributes({ selectVal: val })}

      />
    </div>
  )
}
