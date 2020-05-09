import React, { useState } from 'react';
import Select from 'react-select';

function LocalSelect(props) {
    let { value, options, change } = props;

    // let change = options;

    let onChange = (selected) => {
        if (Array.isArray(selected)){
            change(selected.map(i => i.id))
        }else{
            change([])
        }

    }

    let localValue = options.filter(a => value.indexOf(a.id) !== -1);

    return <Select
        options={options}
        isMulti={true}
        getOptionLabel={a => a.name}
        getOptionValue={a => a.id}
        onChange={onChange}
        value={localValue}

    />
}

export default function ProductAdminAttributes(props) {
    let { attributes, data } = props;
    let [value, setValue] = useState(data)

    let out = [];

    for (let a of attributes) {

        let change = (val) => {
            let newValue = { ...value };
            newValue[a.slug] = val;
            setValue(newValue);
        }

        let localValue = value[a.slug];

        out.push(
            <div key={a.id}>
                {a.name}
                <LocalSelect
                    value={localValue}
                    options={a.items}
                    change={change}
                />
            </div>
        )
    }

    return <div>
        <input type="" name={'attributes'} readOnly={true} value={JSON.stringify(value)} />
        {out}
    </div>
}
